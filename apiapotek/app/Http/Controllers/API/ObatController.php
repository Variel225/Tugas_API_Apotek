<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obat = Obat::with('kategori')-> get();
        return response()-> json($obat,200);
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
                'nama_obat' => 'required',
                'produsen_obat' => 'required',
                'stok' => 'required|integer',
                'harga' => 'required|numeric',
                'kategori_id' => 'required|exists:kategoris,id'
            ]
        );

        $obat = Obat::create($validate);
        if($obat){
            $data['succes'] = true;
            $data['message'] = "Data prodi Berhasil disimpan";
            $data['data'] = $obat;
            return response()->json($data, 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
