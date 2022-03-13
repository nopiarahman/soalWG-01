<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $berita = berita::latest()->paginate(5);
        return view('berita/index',compact('kategori','berita'));
    }
    public function store(Request $request)
    {
        $validasi = $this->validate($request,[
            'judul'=> 'required',
            'isi'=> 'required',
            'kategori_id'=> 'required',
            ]);
        $requestData = $request->all();
        if ($request->hasFile('foto')) {
            $foto            = $request->file('foto')->store('public/berita/foto');
            $requestData['foto'] = $foto;
            
        } else {
            unset($requestData['foto']);
        }
        $requestData['user_id']=auth()->user()->id;
        Berita::create($requestData);
        return redirect()->route('berita')->with('success','Berita Berhasil Disimpan');
        
    }
    public function update(Berita $id, Request $request)
    {
        $validasi = $this->validate($request,[
            'judul'=> 'required',
            'isi'=> 'required',
            'kategori_id'=> 'required',
        ]);
        $requestData = $request->all();
        if ($request->hasFile('foto')) {
            $foto            = $request->file('foto')->store('public/berita/foto');
            $requestData['foto'] = $foto;
            
        } else {
            unset($requestData['foto']);
        }
        $requestData['user_id']=auth()->user()->id;
        $id->update($requestData);
        return redirect()->route('berita')->with('success','Berita Berhasil Dirubah');

    }
    public function destroy(Berita $id)
    {
        $id->delete();
        return redirect()->route('berita')->with('success','Berita Berhasil Dihapus');
        
    }
}
