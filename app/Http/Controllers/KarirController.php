<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir";
        $response = $client->request('GET', $url);
        $content= $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];
       return view('karir.karir',['data'=>$data]);
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
    $job_title = $request->job_title;
    $description = $request->description;
    $location = $request->location;

    $parameter = [
        'job_title'=>$job_title,
        'description'=>$description,
        'location'=>$location,
    ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/karir";
        $response = $client->request('POST', $url,[
            'headers'=>['Content-type'=>'application/json'],
            'body'=>json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
       if($contentArray['status']!= true){
        $error = $contentArray['data'];
        return redirect()->to('karir')->withErrors($error)->withInput();
       }else{
        return redirect()->to('karir')->with('success','Berhasil Memasukan Data');
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

        $parameter = [
            'job_title' => $job_title,
            'description' => $description,
            'location' => $location,
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
            return redirect()->to('karir')->withErrors($error)->withInput();
        } else {
            return redirect()->to('karir')->with('success', 'Berhasil melakukan update Data');
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
}
