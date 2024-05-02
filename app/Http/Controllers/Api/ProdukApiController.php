<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukApiController extends Controller
{
    public function format($produk)
    {

        return [
            'id' => $produk->id,
            'name' => $produk->name,
            'deskripsi' => $produk->deskripsi,
            'harga' => $produk->harga,
            'stock' => $produk->stock,
            'category' => $produk->category,
            'image' => $produk->image,
            'tanggal_tambah_produk' => Carbon::parse($produk->created_at)->translatedFormat('d F Y'),
        ];
    }

    public function respons($produk)
    {
        return response()->json([
            'status' => true,
            'data' => $produk,
        ], 200);
    }

    public function errorStatus($status, $msg)
    {
        return response()->json([
            'status' => $status,
            'message' => $msg,
        ], 200);
    }

    public function indexProduk()
    {
        $produk = Produk::get()
            ->map(function ($produk) {
                return $this->format($produk);
            });
        return $this->respons($produk);
    }

    public function detailProduk($id)
    {
        $produk = Produk::where('id', $id)
            ->get()
            ->map(function ($produk) {
                return $this->format($produk);
            });
        return $this->respons($produk);
    }

    public function createProduk(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);

        if ($validasi->fails()) {
            $valIndex = $validasi->errors()->all();
            return MessageHelper::error(false, $valIndex[0]);
        }

        $produk = Produk::create([
            'name' => $request->name,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'category' => $request->category,
            'stock' => $request->stock,
            'image' => $request->file('image')->store('images'),
        ]);

        $produk = Produk::where('id', $produk->id)
        ->get()
        ->map(function ($produk) {
            return $this->format($produk);
        });
        return $this->respons($produk);
    }

    public function deleteProduk($id){

        $produk = Produk::where('id', $id)->first();

        if(!$produk) {
            return MessageHelper::error(false, 'Data Tidak ditemukan');
        }

        Storage::delete($produk->image);
        $produk->delete();
        return MessageHelper::error(true, 'Berhasil Menghapus Data');
    }

    public function updateProduk(Request $request, $id){
        $produk = Produk::where('id', $id)->first();

        if(!$produk){
            return MessageHelper::error(false, "Data Bootcamp tidak ditemukan !");
        }

        $validasi = Validator::make($request->all(), [
            'name' => ['required'],
            'harga' => 'required|numeric',
            'deskripsi' => ['required'],
            'stock' => ['required'],
            'category' => ['required'],
            'image' => 'nullable',
        ]);

        if($validasi->fails()) {
            $valIndex = $validasi->errors()->all();
            return MessageHelper::error(false, $valIndex[0]);
        }

        $produk->update([
            'name' =>$request->name,
            'deskripsi' =>$request->deskripsi,
            'harga' =>$request->harga,
            'stock' =>$request->stock,
            'category' =>$request->stock,
            // 'image' =>$request->file('image')->store('images'),
        ]);

        $detail = Produk::where('id', $produk->id)
        ->get()
        ->map(function ($produk) {
            return $this->format($produk);
        });

        $msg = "Berhasil Update Data Produk";
        $token = $produk->createToken('auth_token')->plainTextToken;

        return MessageHelper::resulAuth(true, $msg, $detail, 200, $token);
    }
}
