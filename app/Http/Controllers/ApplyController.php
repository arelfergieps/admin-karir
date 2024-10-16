<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        // Filter data berdasarkan status
        $data = array_filter($data, function ($item) {
            return $item['status'] == 1; // Tampilkan hanya yang berstatus 1
        });

        return view('apply.apply', ['data' => $data]); // Mengembalikan data ke apply.blade.php
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'email' => 'required|email|max:255|unique:apply,email',
        //     'no_tlp' => 'required|string|max:20|unique:apply,no_tlp',
        //     'alamat' => 'required|string|max:255',
        //     'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        //     'portofolio' => 'nullable|string|max:255',
        //     'linkdln' => 'nullable|string|max:255',
        //     'github' => 'nullable|string|max:255',
        // ]);

        $nama = $request->nama;
        $email = $request->email;
        $no_tlp = $request->no_tlp;
        $alamat = $request->alamat;

        // Menyimpan file CV
        $cv = $request->file('cv')->store('cv');
        $portofolio = $request->portofolio;
        $linkdln = $request->linkdln;
        $github = $request->github;

        $parameter = [
            'nama' => $nama,
            'email' => $email,
            'no_tlp' => $no_tlp,
            'alamat' => $alamat,
            'cv' => $cv,
            'portofolio' => $portofolio,
            'linkdln' => $linkdln,
            'github' => $github,
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply";

        try {
            // Mengirim request ke API
            $response = $client->request('POST', $url, [
                'multipart' => [
                    ['name' => 'nama', 'contents' => $nama],
                    ['name' => 'email', 'contents' => $email],
                    ['name' => 'no_tlp', 'contents' => $no_tlp],
                    ['name' => 'alamat', 'contents' => $alamat],
                    [
                        'name' => 'cv',
                        'contents' => fopen(storage_path('app/' . $cv), 'r'),
                        'filename' => $cv,
                    ],
                    ['name' => 'portofolio', 'contents' => $portofolio],
                    ['name' => 'linkdln', 'contents' => $linkdln],
                    ['name' => 'github', 'contents' => $github],
                ]
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            // Cek status dan redirect ke halaman apply jika berhasil
            if (isset($contentArray['status']) && $contentArray['status'] == true) {
                return redirect()->back()->with('success', 'Berhasil Memasukkan Data');
            } else {
                return redirect()->back()->withErrors('Terjadi kesalahan: ' . ($contentArray['message'] ?? 'Error tidak diketahui'))->withInput();
            }
        } catch (\Exception $e) {
            // Menangani kesalahan dan mengalihkan kembali dengan pesan kesalahan
            return redirect()->back()->withErrors('Terjadi kesalahan dalam pengiriman data.')->withInput();
        }
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['message'];
            return redirect()->to('karir')->withErrors($error);
        } else {
            $data = $contentArray['data'];
            return view('apply.apply', ['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_tlp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Validasi untuk file CV
            'portofolio' => 'nullable|string|max:255',
            'linkdln' => 'nullable|url',
            'github' => 'nullable|string|max:255',
        ]);

        // Menangani file CV upload
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv'); // Simpan file di storage
        }

        $parameter = [
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'no_tlp' => $validatedData['no_tlp'],
            'alamat' => $validatedData['alamat'],
            'cv' => $cvPath, // Path file CV
            'portofolio' => $validatedData['portofolio'],
            'linkdln' => $validatedData['linkdln'],
            'github' => $validatedData['github'],
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply/$id";

        try {
            $response = $client->request('PUT', $url, [
                'headers' => ['Content-type' => 'application/json'],
                'body' => json_encode($parameter)
            ]);

            $content = $response->getBody()->getContents();
            $contentArray = json_decode($content, true);

            if ($contentArray['status'] != true) {
                $error = $contentArray['message'] ?? 'Terjadi kesalahan saat mengupdate data.';
                return redirect()->to('apply')->withErrors($error)->withInput();
            } else {
                return redirect()->to('apply')->with('success', 'Berhasil melakukan update Data');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan yang tidak terduga
            return redirect()->to('apply')->withErrors('Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply/$id";
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('apply')->withErrors($error)->withInput();
        } else {
            return redirect()->to('apply')->with('success', 'Berhasil melakukan Hapus Data');
        }
    }

    public function view_cv(string $id)
    {
        $data = Apply::findOrFail($id); // Sesuaikan dengan model dan kolom yang sesuai
        $pdfPath = public_path('storage/' . $data->cv);
        return response()->file($pdfPath);
    }
    public function accept($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply/$id/accept"; // Sesuaikan dengan endpoint API Anda
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['message'] ?? 'Terjadi kesalahan saat mengupdate status pelamar.';
            return redirect()->back()->withErrors($error)->withInput();
        }

        return redirect()->back()->with('success', 'Pelamar diterima.');
    }

    public function reject($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply/$id/reject"; // Sesuaikan dengan endpoint API Anda
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['message'] ?? 'Terjadi kesalahan saat mengupdate status pelamar.';
            return redirect()->back()->withErrors($error)->withInput();
        }

        return redirect()->back()->with('success', 'Pelamar ditolak.');
    }

    public function indexAccepted()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        // Filter data berdasarkan status 2 (diterima)
        $data = array_filter($data, function ($item) {
            return $item['status'] == 2;
        });

        // Mengembalikan data ke view terima.blade.php
        return view('terima.terima', ['data' => $data]);
    }

    public function indexRejected()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/apply";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        // Filter data berdasarkan status 3 (ditolak)
        $data = array_filter($data, function ($item) {
            return $item['status'] == 3;
        });

        // Mengembalikan data ke view tolak.blade.php
        return view('tolak.tolak', ['data' => $data]);
    }



}
