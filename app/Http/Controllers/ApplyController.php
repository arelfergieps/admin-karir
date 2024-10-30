<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil status dari request, jika tidak ada maka default ke 1
        $status = $request->input('status', 1);
        // Ambil per_page dari request, jika tidak ada maka default ke 5
        $perPage = $request->input('per_page', 5);

        // Ambil data pelamar dari database
        $data = Apply::where('status', $status)->paginate($perPage);

        // Kembalikan data ke apply.blade.php
        return view('apply.apply', ['data' => $data]);
    }

    public function destroy(string $id)
    {
        $apply = Apply::findOrFail($id);

        if ($apply->delete()) {
            return redirect()->to('apply')->with('success', 'Berhasil melakukan Hapus Data');
        } else {
            return redirect()->to('apply')->withErrors('Gagal menghapus data.')->withInput();
        }
    }

    public function view_cv(string $id)
    {
        $data = Apply::findOrFail($id);
        $pdfPath = public_path('storage/' . $data->cv);
        return response()->file($pdfPath);
    }

    public function accept($id)
    {
        $apply = Apply::findOrFail($id);
        $apply->status = 2; // Assuming status 2 means accepted
        if ($apply->save()) {
            return redirect()->back()->with('success', 'Pelamar diterima.');
        } else {
            return redirect()->back()->withErrors('Terjadi kesalahan saat mengupdate status pelamar.')->withInput();
        }
    }

    public function reject($id)
    {
        $apply = Apply::findOrFail($id);
        $apply->status = 3; // Assuming status 3 means rejected
        if ($apply->save()) {
            return redirect()->back()->with('success', 'Pelamar ditolak.');
        } else {
            return redirect()->back()->withErrors('Terjadi kesalahan saat mengupdate status pelamar.')->withInput();
        }
    }

    public function terima()
    {
        // Mengambil data dengan status 2
        $data = Apply::where('status', 2)->get();

        // Mengembalikan data ke view terima.blade.php
        return view('terima', ['data' => $data]);
    }

    public function tolak()
    {
        // Mengambil data dengan status 3
        $data = Apply::where('status', 3)->get();

        // Mengembalikan data ke view tolak.blade.php
        return view('tolak', ['data' => $data]);
    }
    
}
