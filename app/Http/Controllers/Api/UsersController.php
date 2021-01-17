<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request) {
        return [
            'users' => DB::table('users')->paginate(5),
            'roles' => Role::all(),
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {
        // TODO method
        return User::insert($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function destroy(Request $request, $id) {
        User::destroy($id);
        return ['status' => 'success', 'id' => $id];
    }
}
