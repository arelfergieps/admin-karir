<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Apply::orderBy('nama', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataApply = new Apply;

        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:apply,email', // Validasi email unik
            'no_tlp' => 'required|unique:apply,no_tlp', // Validasi no_tlp unik
            'alamat' => 'required',
            'cv' => 'required',
            'portofolio' => 'nullable', // Kolom ini bisa kosong
            'linkdln' => 'nullable|url', // Validasi linkdln
            'github' => 'nullable|url', // Validasi github
            'status' => 'required|in:1,2,3' // Validasi status harus 1, 2, atau 3
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data',
                'data' => $validator->errors()
            ]);
        }

        // Menyimpan data
        $dataApply->nama = $request->nama;
        $dataApply->email = $request->email;
        $dataApply->no_tlp = $request->no_tlp;
        $dataApply->alamat = $request->alamat;
        $dataApply->cv = $request->cv;
        $dataApply->portofolio = $request->portofolio;
        $dataApply->linkdln = $request->linkdln; // Menyimpan linkdln
        $dataApply->github = $request->github;   // Menyimpan github
        $dataApply->status = $request->status;   // Menyimpan status

        $dataApply->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Apply::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
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

        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:apply,email,' . $dataApply->id, // Mengizinkan email yang sama saat update
            'no_tlp' => 'required|unique:apply,no_tlp,' . $dataApply->id, // Mengizinkan no_tlp yang sama saat update
            'alamat' => 'required',
            'cv' => 'required',
            'portofolio' => 'nullable', // Kolom ini bisa kosong
            'linkdln' => 'nullable|url', // Validasi linkdln
            'github' => 'nullable|url', // Validasi github
            'status' => 'required|in:1,2,3' // Validasi status harus 1, 2, atau 3
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ]);
        }

        // Mengupdate data
        $dataApply->nama = $request->nama;
        $dataApply->email = $request->email;
        $dataApply->no_tlp = $request->no_tlp;
        $dataApply->alamat = $request->alamat;
        $dataApply->cv = $request->cv;
        $dataApply->portofolio = $request->portofolio;
        $dataApply->linkdln = $request->linkdln; // Mengupdate linkdln
        $dataApply->github = $request->github;   // Mengupdate github
        $dataApply->status = $request->status;   // Mengupdate status

        $dataApply->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data'
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
}
