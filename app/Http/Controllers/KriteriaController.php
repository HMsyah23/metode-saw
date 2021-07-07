<?php

namespace App\Http\Controllers;

use App\Kriteria;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class KriteriaController extends Controller
{

    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index',compact('kriterias'));
    }


    public function create()
    {
        //
    }


    public function store(Request $r)
    {
        $rules = [
            'kode'                  => 'required|min:2|max:4',
            'nama'                  => 'required|min:1|max:50',
            'tipe'                  => 'required|',
            'bobot'                 => 'required|numeric|between:0,1'
        ];
 
        $messages = [
            'nama.required'         => 'Nama wajib diisi',
            'nama.min'              => 'Nama minimal 1 karakter',
            'nama.max'              => 'Nama maksimal 50 karakter',
            'kode.required'         => 'Kode wajib diisi',
            'kode.min'              => 'Kode minimal 4 karakter',
            'kode.max'              => 'Kode maksimal 4 karakter',
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }
 
        $kriteria = new Kriteria;
        $kriteria->nama = ucwords(strtolower($r->nama));
        $kriteria->kode = $r->kode;
        $kriteria->tipe = $r->tipe;
        $kriteria->bobot = $r->bobot;
        $simpan = $kriteria->save();
 
        if($simpan){
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }


    public function show(Kriteria $kriteria)
    {
        //
    }

    public function edit($id, Request $r)
    {
        
    }

    public function update(Request $r,$id)
    {
        $kriteria = Kriteria::find($id);
        $rules = [
            'tipe-'.$kriteria->id   => 'required|',
            'bobot-'.$kriteria->id               => 'required|numeric|between:0,1'
        ];
    
        $messages = [
            'bobot-'.$kriteria->id.'.between' => 'Bobot Hanya Memiliki skala 0 sampai 1',
        ];
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }
        $kriteria->update([
            'tipe' => $r->input('tipe-'.$id),
            'bobot' => $r->input('bobot-'.$id),
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diperbarui!');
    }


    public function destroy(Kriteria $kriteria)
    {
        //
    }
}
