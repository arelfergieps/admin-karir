<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karir;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan data karir, dengan opsi filter untuk status aktif (status = 1)
     */
    public function index(Request $request)
    {
        // Filter status jika disediakan, defaultnya null untuk mengambil semua data
        $filterStatus = $request->input('status', 1); // Set default ke 1 untuk hanya menampilkan status aktif
        $query = Karir::query();

        // Hanya ambil data dengan status 1
        if ($filterStatus == 1) {
            $query->where('status', 1);  // Tambahkan filter status untuk status 1 (aktif)
        }

        $data = $query->get(); // Ambil data dari database

        return view('karir.karir', ['data' => $data]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $karir = new Karir;
        $karir->job_title = $request->job_title;
        $karir->description = $request->description;
        $karir->location = $request->location;
        $karir->kategori = $request->kategori;
        $karir->kualifikasi = $request->kualifikasi;
        $karir->divisi = $request->divisi;
        $karir->gaji = $request->gaji;
        $karir->status = $request->status;

        if ($karir->save()) {
            return redirect()->to('karir')->with('success', 'Berhasil Memasukan Data');
        } else {
            return redirect()->to('karir')->withErrors('Gagal Memasukan Data')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karir = Karir::find($id);

        if (!$karir) {
            return redirect()->to('karir')->withErrors('Data tidak ditemukan');
        }

        return view('karir.edit', ['data' => $karir]); // Gunakan view edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $karir = Karir::find($id);

        if (!$karir) {
            return redirect()->back()->withErrors('Data tidak ditemukan')->withInput();
        }

        $karir->job_title = $request->job_title;
        $karir->description = $request->description;
        $karir->location = $request->location;
        $karir->kategori = $request->kategori;
        $karir->kualifikasi = $request->kualifikasi;
        $karir->divisi = $request->divisi;
        $karir->gaji = $request->gaji;
        $karir->status = $request->status;

        if ($karir->save()) {
            if ($karir->status == 1) {
                return redirect()->to('karir')->with('success', 'Berhasil melakukan update Data');
            } elseif ($karir->status == 2) {
                return redirect()->to('karir/hidden_karir')->with('success', 'Berhasil mengupdate status, data dipindahkan ke halaman Hidden Karir');
            }
        } else {
            return redirect()->back()->withErrors('Gagal memperbarui data')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karir = Karir::find($id);

        if (!$karir) {
            return redirect()->to('karir')->withErrors('Data tidak ditemukan');
        }

        if ($karir->delete()) {
            return redirect()->to('karir')->with('success', 'Berhasil melakukan Hapus Data');
        } else {
            return redirect()->to('karir')->withErrors('Gagal menghapus data');
        }
    }

    /**
     * Display a listing of hidden resources (status = 2).
     */
    public function hiddenKarir(Request $request)
    {
        // Mengambil data karir yang tersembunyi
        $data = Karir::where('status', 2)->paginate(10);

        return view('karir.hidden_karir', ['data' => $data]);
    }

    // Di dalam KarirController
    // public function countActiveKarir()
    // {
    //     $countActiveJobs = Karir::where('status', 1)->count(); // Menghitung jumlah pekerjaan aktif
    //     return view('admin', ['countActiveJobs' => $countActiveJobs]); // Pass ke view
    // }

}
