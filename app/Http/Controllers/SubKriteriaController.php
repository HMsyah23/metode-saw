<?php

namespace App\Http\Controllers;

use App\SubKriteria;
use App\Kriteria;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class SubKriteriaController extends Controller
{

    public function index()
    {
        $subkriterias = Subkriteria::all();
        $kriterias = kriteria::all();
        return view('subkriteria.index',compact('subkriterias','kriterias'));
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        $rules = [
            'kodeSub'                  => 'required|min:2|max:4',
            'kondisi'               => 'required|min:1|max:50',
            'nilai'                 => 'required|numeric|between:1,100'
        ];
 
        $messages = [
            'kondisi.required'      => 'Kondisi wajib diisi',
            'kondisi.min'           => 'Kondisi minimal 1 karakter',
            'kondisi.max'           => 'Kondisi maksimal 50 karakter',
            'kodeSub.required'         => 'Kode wajib diisi',
            'kodeSub.min'              => 'Kode minimal 2 karakter',
            'kodeSub.max'              => 'Kode maksimal 4 karakter',
        ];
 
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }
 
        $krit = Kriteria::where('id',$r->kode)->first();

        $kriteria = new SubKriteria;
        $kriteria->kode = $r->kodeSub;
        $kriteria->id_kriteria = $krit->id;
        $kriteria->kondisi = $r->kondisi;
        $kriteria->nilai = $r->nilai;
        $simpan = $kriteria->save();
 
        if($simpan){
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }

    public function show(SubKriteria $subKriteria)
    {
        //
    }

    public function edit(SubKriteria $subKriteria)
    {
        //
    }

    public function update(Request $r, $id){
        $kriteria = SubKriteria::find($id);
        $rules = [
            'nilai-'.$kriteria->id         => 'required|numeric|between:1,100'
        ];
    
        $messages = [
            'nilai-'.$kriteria->id.'.between' => 'nilai Hanya Memiliki skala 1 sampai 100',
        ];
        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all);
        }
        $kriteria->update([
            'nilai' => $r->input('nilai-'.$id),
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diperbarui!');
    }

    public function destroy(SubKriteria $subKriteria)
    {
        //
    }
}
