<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apply;
use App\Models\Karir;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        return view('admin');
    }
    public function dashboard()
    {
        // Ambil jumlah pekerjaan aktif
        $countActiveJobs = Karir::where('status', 1)->count();
        // Ambil jumlah pelamar dengan status 1
        $countApplicantsStatus1 = Apply::where('status', 1)->count();
        $countApplicantsStatus2 = Apply::where('status', 2)->count();
        $countApplicantsStatus3 = Apply::where('status', 3)->count();

        return view('admin', [
            'countActiveJobs' => $countActiveJobs,
            'countApplicantsStatus1' => $countApplicantsStatus1,
            'countApplicantsStatus2' => $countApplicantsStatus2,
            'countApplicantsStatus3' => $countApplicantsStatus3
        ]);
    }
}
