<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan data karir, dengan opsi filter untuk status aktif (status = 1)
     */
    public function index(Request $request)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir";

        // Jika ingin hanya menampilkan yang status aktif (status = 1)
        $filterStatus = $request->input('status', null);
        if ($filterStatus !== null) {
            $url .= '?status=' . $filterStatus;  // Tambahkan filter status jika diberikan
        }

        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('karir.karir', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $job_title = $request->job_title;
        $description = $request->description;
        $location = $request->location;
        $kategori = $request->kategori;
        $kualifikasi = $request->kualifikasi;
        $divisi = $request->divisi;
        $gaji = $request->gaji;
        $status = $request->status;

        $parameter = [
            'job_title' => $job_title,
            'description' => $description,
            'location' => $location,
            'kategori' => $kategori,
            'kualifikasi' => $kualifikasi,
            'divisi' => $divisi,
            'gaji' => $gaji,
            'status' => $status,
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('karir')->withErrors($error)->withInput();
        } else {
            return redirect()->to('karir')->with('success', 'Berhasil Memasukan Data');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['message'];
            return redirect()->to('karir')->withErrors($error);
        } else {
            $data = $contentArray['data'];
            return view('karir.karir', ['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job_title = $request->job_title;
        $description = $request->description;
        $location = $request->location;
        $kategori = $request->kategori;
        $kualifikasi = $request->kualifikasi;
        $divisi = $request->divisi;
        $gaji = $request->gaji;
        $status = $request->status; // Status yang diubah, bisa 1 atau 2

        $parameter = [
            'job_title' => $job_title,
            'description' => $description,
            'location' => $location,
            'kategori' => $kategori,
            'kualifikasi' => $kualifikasi,
            'divisi' => $divisi,
            'gaji' => $gaji,
            'status' => $status,
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->back()->withErrors($error)->withInput();
        } else {
            if ($status == 1) {
                // Jika status 1, kembalikan ke halaman karir
                return redirect()->to('karir')->with('success', 'Berhasil melakukan update Data');
            } elseif ($status == 2) {
                // Jika status 2, pindahkan ke halaman hidden karir
                return redirect()->to('karir/hidden_karir')->with('success', 'Berhasil mengupdate status, data dipindahkan ke halaman Hidden Karir');
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir/$id";
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('karir')->withErrors($error)->withInput();
        } else {
            return redirect()->to('karir')->with('success', 'Berhasil melakukan Hapus Data');
        }
    }



    /**
     * Display a listing of hidden resources (status = 2).
     */
    public function hiddenKarir(Request $request)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir"; // Panggil endpoint API Anda

        // Tambahkan status sebagai query parameter
        $response = $client->request('GET', $url, [
            'query' => [
                'status' => 2, // Mengambil pekerjaan dengan status 2
                'per_page' => 10 // Jumlah data per halaman
            ]
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        // Pastikan data yang diterima
        $data = $contentArray['data']['data'] ?? []; // Mengakses data di dalam sub-array 'data'

        return view('karir.hidden_karir', ['data' => $data]);
    }



}
