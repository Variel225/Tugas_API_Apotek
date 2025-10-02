<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori,200);
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
        $validate = $request->validate(
            [
                'nama_kategori' => 'required',
                'deskripsi' => 'required'
            ]
        );

        $kategori = Kategori::create($validate);
        if($kategori){
            $data['succes'] = true;
            $data['message'] = "Kategori berhasil Ditambahkan";
            $data['data'] = $kategori;
            return response()->json($data, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json($kategori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate(
            [
                'nama_kategori' => 'required',
                'deskripsi' => 'required'
            ]
        );

        // update data kategori
        $kategori = Kategori::where('id', $id)->update($validate);
        //menampilkan data
        $kategori = Kategori::find($id);
        if ($kategori){
            $data['succes'] = true;
            $data['message'] = "Kategori Berhasil diperbarui";
            $data['data'] = $kategori;
            return response()->json($data, Response::HTTP_OK);
        }
        else{
            $data['succes'] = false;
            $data['message'] = "Kategori tidak ditemukan";
            $data['data'] = $kategori;
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::where('id',$id);
        if ($kategori){
            $kategori->delete(); //hapus data berdasarkan id
            $data['succes'] = true;
            $data['message'] = "Kategori Berhasil Dihapus";
            $data['data'] = $kategori;
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['succes'] = false;
            $data['message'] = "Kategori tidak ditemukan";
            $data['data'] = $kategori;
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
