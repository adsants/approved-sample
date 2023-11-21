<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoAccessController extends Controller
{
    public function index()
    {
        return view('no_access');
    }
}