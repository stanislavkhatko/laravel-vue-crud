<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index() {
        return User::all();
    }
}
