<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\karir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = karir::orderBy('job_title', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data di temukan',
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
    'job_title'=>'required',
    'description'=>'required',
    'location'=>'required'

];
$validator = Validator::make($request->all(),$rules);
if($validator->fails()){
    return response()->json([
'status'=>false,
'message'=>'Gagal memasukan data',
'data'=>$validator->errors()
    ]);
}

        $dataKarir->job_title = $request->job_title;
        $dataKarir->description = $request->description;
        $dataKarir->location = $request->location;

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
        $data = karir::find($id);
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
        if(empty($dataKarir)){
            return response()->json([
                'status'=>false,
                'message'=>'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
                'job_title' => 'required',
                'description' => 'required',
                'location' => 'required'

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
