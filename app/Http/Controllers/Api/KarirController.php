<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Tangani query pencarian
        $search = $request->input('search', '');

        // Jika ada pencarian, lakukan query dengan filter dan hanya tampilkan yang statusnya 'show' (1)
        if ($search) {
            $data = Karir::where('status', 1) // Menampilkan hanya yang statusnya "show"
                ->where('job_title', 'like', "%{$search}%")
                ->orderBy('job_title', 'asc')
                ->paginate(5);
        } else {
            $data = Karir::where('status', 1) // Menampilkan hanya yang statusnya "show"
                ->orderBy('job_title', 'asc')
                ->paginate(5);
        }

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
        $dataKarir = new Karir;

        $rules = [
            'job_title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'kategori' => 'required',
            'kualifikasi' => 'required',
            'divisi' => 'required',
            'gaji' => 'required|numeric',
            'status' => 'required|in:1,2' // Status hanya boleh 1 (show) atau 2 (hide)
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukan data',
                'data' => $validator->errors()
            ]);
        }

        $dataKarir->job_title = $request->job_title;
        $dataKarir->description = $request->description;
        $dataKarir->location = $request->location;
        $dataKarir->kategori = $request->kategori;
        $dataKarir->kualifikasi = $request->kualifikasi;
        $dataKarir->divisi = $request->divisi;
        $dataKarir->gaji = $request->gaji;
        $dataKarir->status = $request->status;

        $post = $dataKarir->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukan data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Karir::find($id);
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
        $dataKarir = Karir::find($id);
        if (empty($dataKarir)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'job_title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'kategori' => 'required',
            'kualifikasi' => 'required',
            'divisi' => 'required',
            'gaji' => 'required|numeric',
            'status' => 'required|in:1,2' // Status hanya boleh 1 (show) atau 2 (hide)
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal melakukan update data',
                'data' => $validator->errors()
            ]);
        }

        $dataKarir->job_title = $request->job_title;
        $dataKarir->description = $request->description;
        $dataKarir->location = $request->location;
        $dataKarir->kategori = $request->kategori;
        $dataKarir->kualifikasi = $request->kualifikasi;
        $dataKarir->divisi = $request->divisi;
        $dataKarir->gaji = $request->gaji;
        $dataKarir->status = $request->status;

        $post = $dataKarir->save();

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
        $dataKarir = Karir::find($id);
        if (empty($dataKarir)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $post = $dataKarir->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan Hapus data'
        ]);
    }
}
