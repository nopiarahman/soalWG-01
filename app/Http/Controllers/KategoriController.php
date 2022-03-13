<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view("kategori/index",compact('kategori'));
    }
    public function store(Request $request)
    {
        $validasi = $this->validate($request,[
            'nama'=> 'required',
            ]);
        Kategori::create($request->all());
        return redirect()->route('kategori')->with('success','Kategori Berhasil Disimpan');
    }
    public function update(Request $request, Kategori $id)
    {
        $validasi = $this->validate($request,[
            'nama'=> 'required',
        ]);
        $id->update($request->all());
        return redirect()->route('kategori')->with('success','Kategori Berhasil Dirubah');
    }
    public function destroy(Kategori $id)
    {
        if($id->relation){
            return redirect()->back()->with('error','Gagal. Kategori telah dimiliki oleh berita!');
        }
        $id->delete();
        return redirect()->back()->with('success','Kategori Berhasil Dihapus');
    }
}
