<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        return view('admin');
    }
    // function admin(){
    //     echo "Halo, Selamat Datang di halaman admin";
    //     echo "<h1>".Auth::user()->name."</h1>";
    //     echo "<a href='/logout'>Logout >></a>";
    // }
}
