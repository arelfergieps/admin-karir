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
        $search = $request->input('search', '');
        $status = $request->input('status', 1); // Default ke status 1
        $perPage = $request->input('per_page', 5); // Data per halaman

        $query = Karir::query(); // Membuat query builder

        // Filter berdasarkan status jika ada
        if ($status) {
            $query->where('status', $status);
        }

        // Tambahkan pencarian berdasarkan judul pekerjaan
        if ($search) {
            $query->where('job_title', 'like', "%{$search}%");
        }

        // Urutkan dan paginate hasilnya
        $data = $query->orderBy('job_title', 'asc')->paginate($perPage);

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
            // 'status' => 'required|in:1,2' // Status hanya boleh 1 (show) atau 2 (hide)
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
        // $dataKarir->status = 1;

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

    /**
     * Toggle the status of the specified resource.
     */
    // public function toggleStatus(string $id)
    // {
    //     $dataKarir = Karir::find($id);
    //     if (empty($dataKarir)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Data tidak ditemukan'
    //         ], 404);
    //     }

    //     // Toggle status
    //     $dataKarir->status = $dataKarir->status == 1 ? 2 : 1; // 1 = aktif, 2 = non-aktif
    //     $dataKarir->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Status berhasil diubah'
    //     ]);
    // }
    

}
