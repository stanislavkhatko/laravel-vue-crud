<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request) {
        $users = DB::table('users')->paginate(5);

        return [
            'users' => $users,
            'roles' => Role::all(),
        ];
    }

    public function store(Request $request) {
        $user = User::insert($request);
        return $user;
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy(Request $request, $id) {
        User::destroy($id);
        return ['status' => 'success', 'id' => $id];
    }
}
