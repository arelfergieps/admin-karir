<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource for status 1.
     */
    public function index()
    {
        // Hanya menampilkan data dengan status 1
        $data = Apply::where('status', 1)->orderBy('nama', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Display a listing of accepted applications (status 2).
     */
    // public function accepted()
    // {
    //     // Menampilkan data dengan status 2
    //     $data = Apply::where('status', 2)->orderBy('nama', 'asc')->get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data diterima ditemukan',
    //         'data' => $data
    //     ], 200);
    // }

    // /**
    //  * Display a listing of rejected applications (status 3).
    //  */
    // public function rejected()
    // {
    //     // Menampilkan data dengan status 3
    //     $data = Apply::where('status', 3)->orderBy('nama', 'asc')->get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data ditolak ditemukan',
    //         'data' => $data
    //     ], 200);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataApply = new Apply;

        $rules = [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255', // Hapus 'unique'
            'no_tlp' => 'required|string|max:20', // Hapus 'unique'
            'alamat' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:2048', // Validasi untuk CV sebagai file PDF
            'portofolio' => 'nullable|string|max:255',
            'linkdln' => 'nullable|url|max:255',
            'github' => 'nullable|string|max:255', // Mengizinkan teks biasa dengan panjang maksimum 255 karakter
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan data
        $dataApply->nama = $request->nama;
        $dataApply->email = $request->email;
        $dataApply->no_tlp = $request->no_tlp;
        $dataApply->alamat = $request->alamat;

        if ($request->hasFile('cv')) {
            $pdfFile = $request->file('cv');
            $sertif = $pdfFile->store('cv', 'public');
            $dataApply->cv = $sertif;
        }

        $dataApply->portofolio = $request->portofolio;
        $dataApply->linkdln = $request->linkdln;
        $dataApply->github = $request->github;

        $dataApply->save();

        // Redirect ke halaman apply.blade.php dengan pesan sukses
        return redirect()->route('apply.index')->with('success', 'Sukses memasukkan data');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataApply = Apply::find($id);
        if (empty($dataApply)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Validasi hanya status saat update
        $rules = [
            'status' => 'required|in:1,2,3', // Validasi status saat update
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update status',
                'data' => $validator->errors()
            ]);
        }

        // Mengupdate status
        $dataApply->status = $request->status;

        $dataApply->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update status'
        ]);
    }

    public function updateStatus(Request $request, string $id)
    {
        $dataApply = Apply::find($id);
        if (empty($dataApply)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Mengubah status ke 2 (diterima)
        $dataApply->status = 2; // atau sesuai status yang Anda inginkan

        $dataApply->save();

        return response()->json([
            'status' => true,
            'message' => 'Status pelamar berhasil diubah menjadi diterima'
        ]);
    }

    /**
     * Update the status of a specified resource to rejected.
     */
    public function reject(Request $request, string $id)
    {
        // Mencari data pelamar berdasarkan ID
        $dataApply = Apply::find($id);
        if (empty($dataApply)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Mengubah status ke 3 (ditolak)
        $dataApply->status = 3; // Sesuaikan ini sesuai kebutuhan

        // Menyimpan perubahan
        $dataApply->save();

        return response()->json([
            'status' => true,
            'message' => 'Status pelamar berhasil diubah menjadi ditolak'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataApply = Apply::find($id);
        if (empty($dataApply)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $dataApply->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan hapus data'
        ]);
    }

    // /**
    //  * Display a listing of accepted applications (status 2).
    //  */
    // public function accepted()
    // {
    //     // Menampilkan data dengan status 2
    //     $data = Apply::where('status', 2)->orderBy('nama', 'asc')->get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data diterima ditemukan',
    //         'data' => $data
    //     ], 200);
    // }

    // /**
    //  * Display a listing of rejected applications (status 3).
    //  */
    // public function rejected()
    // {
    //     // Menampilkan data dengan status 3
    //     $data = Apply::where('status', 3)->orderBy('nama', 'asc')->get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data ditolak ditemukan',
    //         'data' => $data
    //     ], 200);
    // }


}
