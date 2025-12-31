<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kontak;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan seluruh data
        $kontak = Kontak::all();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil diambil',
            'data' => $kontak
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi eror',
                'errors' => $validator->errors()
            ], 422);
        }
        // simpan data ke database
        $kontak = Kontak::create($request->all());

        // respon jika data berhasil ditambahkan
        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditambahkan',
            'data' => $kontak
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // mencari data berdasarkan ID, jika tidak ada akan error 404
        $kontak = Kontak::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditemukan',
            'data' => $kontak
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20'
        ]);

        // respon jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi eror',
                'errors' => $validator->errors()
            ], 422);
        }

        // cari data berdasarkan ID, jika tidak ada akan return 404
        $kontak = Kontak::findOrFail($id);

        // proses update data
        $kontak->update($request->all());

        // respon jika data berhasil diedit
        return response()->json([
            'status' => true,
            'message' => 'data berhasil diedit',
            'data' => $kontak
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();
        return response()->json([
            'status' => true,
            'massage' => 'Data berhasil dihpuas',
            'data' => $kontak
        ]);
    }
}
