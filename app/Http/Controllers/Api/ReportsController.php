<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index() {
        return [
            'users' => User::all()->append(['lines_read', 'times_read', 'reward']),
            'transactions' => Transaction::all()
        ];
    }
}
