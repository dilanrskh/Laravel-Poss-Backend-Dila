<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function indexProduk(){
        $produk = Produk::all();
        return view('Admin.Produk.indexProduk', compact('produk'));
    }

    public function dataProdukForm(){
        return view('Admin.Produk.createProduk');
    }

    public function dataProdukCreate(Request $request){
        $request->validate([
            'name' => 'required',
            'harga' => 'required',
            'stock' => 'required',
            'category' => 'required',
            'deskripsi' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $data = $request->all();

        Produk::create([
            'name' => $request->name,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'deskripsi' => $request->deskripsi,
            'category' => $request->category,
            'image' => $filename,
        ]);

        return redirect()->route('index.produk')->with('Create', 'Produk berhasil ditambahkan');
    }

    public function dataProdukFormEdit($id){
        $produk = Produk::findOrFail($id);
        return view('Admin.Produk.editProduk', compact('produk'));
    }

    public function dataProdukUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'harga' => 'required',
            'stock' => 'required',
            'category' => 'required',
            'deskripsi' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $produk = Produk::findOrFail($id);

        if($request->file('image') == "") {
            $produk->update([
                'name' => $request->name,
                'harga' => $request->harga,
                'stock' => $request->stock,
                'deskripsi' => $request->deskripsi,
                'category' => $request->category,
            ]);
        } else {
            $image = $request->file('image');
            $namaFIle = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $namaFIle);

            $produk->update([
                'name' => $request->name,
                'harga' => $request->harga,
                'stock' => $request->stock,
                'deskripsi' => $request->deskripsi,
                'category' => $request->category,
                'image' => $namaFIle,
            ]);
        }
        return redirect()->route('index.produk')->with('Create', 'Produk berhasil Di Update');
    }

    public function dataProdukSeacrh(Request $request){
        if($request->has('search')){
            $produk = Produk::where('name', 'LIKE', '%'.$request->search.'%')->get();
        }else{
            $produk = Produk::all();
        }

        return view('Admin.Produk.indexProduk', compact('produk'));
    }

    public function dataProdukDelete(Request $request){
        $produk = Produk::findOrFail($request->id);
        $produk->delete();

        return redirect()->route('index.produk')->with('Delete', 'Produk berhasil Di Dihapus');
    }
}
