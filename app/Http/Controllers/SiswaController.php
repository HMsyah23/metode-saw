<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\RelasiTabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use Session;

class SiswaController extends Controller
{

    public function index()
    {
        $siswas = Siswa::all();
        return view('siswa.index',compact('siswas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        $rules = [
            'nama'               => 'required|max:100',
            'nik'                => 'required|min:16|max:16|unique:siswas,nik',
            'potensi'            => 'required',
            'tanggal_lahir'      => 'required',
            'alamat'             => 'required',
            'jenis_kelamin'             => 'required',
            'penghasilan'        => 'required',
            'jarak_rumah'        => 'required',
            'foto'               => 'required|max:10000|mimes:jpg,png,jpeg',
            'foto_kk'            => 'required|max:10000|mimes:pdf,jpg,png,jpeg',
            'foto_akta'          => 'required|max:10000|mimes:pdf,jpg,png,jpeg',
        ];
 
        $messages = [
            'nama.required'         => 'Nama wajib diisi',
            'nama.max'              => 'Nama maksimal 100 karakter',
            'nik.required'          => 'NIK wajib diisi',
            'nik.unique'            => 'NIK Sudah Terdaftar, Mohon input data yang valid',
            'nik.min'               => 'NIK berjumlah 16 Digit',
            'nik.max'               => 'NIK berjumlah 16 Digit',
            'tanggal_lahir.required'    => 'Tanggal Lahir wajib diisi',
            'potensi.required'      => 'Potensi wajib diisi',
            'alamat.required'       => 'Alamat wajib diisi',
            'penghasilan.required'  => 'Penghasilan wajib diisi',
            'jarak_rumah.required'  => 'Jarak Rumah wajib diisi',
            'foto.required'         => 'Foto Calon Siswa Belum Diunggah',
            'foto.max'              => 'File Foto melebihi batas maksimal, ukuran maksimal : 10Mb',
            'foto.mimes'            => 'Sistem hanya menerima file berformat jpg,png,jpeg',
            'foto_kk.required'      => 'File Kartu Keluarga Calon Siswa Belum Diunggah',
            'foto_kk.max'           => 'File Kartu Keluarga melebihi batas maksimal, ukuran maksimal : 10Mb',
            'foto_kk.mimes'         => 'Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
            'foto_akta.required'    => 'File Akta Kelahiran Calon Siswa Belum Diunggah',
            'foto_akta.max'         => 'File Akta Kelahiran melebihi batas maksimal, ukuran maksimal : 10Mb',
            'foto_akta.mimes'       => 'Sistem hanya menerima file berformat pdf,jpg,png,jpeg',
        ];

        $years = Carbon::parse($r->tanggal_lahir)->age;

        if ($years < 6) {
            Session::flash('error', 'Data Gagal Ditambahkan! Umur Siswa Minimal 6 Tahun');
            return redirect()->back()->withInput($r->all());;
        }

        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all());
        }


 
        $r->foto->store('siswa/foto', 'public');
        $r->foto_kk->store('siswa/kk', 'public');
        $r->foto_akta->store('siswa/akta_kelahiran', 'public');

        $siswa = new Siswa;
        $siswa->nama_siswa = $r->nama;
        $siswa->nik = $r->nik;
        $siswa->jenis_kelamin = $r->jenis_kelamin;
        $siswa->alamat = $r->alamat;
        $siswa->umur = $years;
        $siswa->tanggal_lahir = $r->tanggal_lahir;
        $siswa->jarak_sekolah = $r->jarak_rumah;
        $siswa->potensi_akademik = $r->potensi;
        $siswa->penghasilan_orang_tua = $r->penghasilan;
        $siswa->foto_anak = $r->foto->hashName();
        $siswa->foto_kk = $r->foto_kk->hashName();
        $siswa->akta_kelahiran = $r->foto_akta->hashName();
        $simpan = $siswa->save();

        

        if ($r->umur <= 6) {
            $umur = 'C11';
        } elseif ($r->umur == 7) {
            $umur = 'C12';
        } elseif ($r->umur == 8) {
            $umur = 'C13';
        } elseif ($r->umur > 8) {
            $umur = 'C14';
        }

        if ($r->jarak_rumah < 2) {
            $jarak = 'C21';
        } elseif (($r->jarak_rumah >= 2) and ($r->jarak_rumah <= 5.9)) {
            $jarak = 'C22';
        } elseif (($r->jarak_rumah >= 6) and ($r->jarak_rumah <= 10)) {
            $jarak = 'C23';
        } elseif ($r->jarak_rumah > 10) {
            $jarak = 'C24';
        }
        
        if ($r->potensi == "Kurang Berpotensi") {
            $potensi = 'C31';
        } elseif ($r->potensi == "Cukup Berpotensi") {
            $potensi = 'C32';
        } elseif ($r->potensi == "Berpotensi") {
            $potensi = 'C33';
        } elseif ($r->potensi == "Sangat Berpotensi") {
            $potensi = 'C34';
        }

        if ($r->penghasilan < 1500000) {
            $penghasilan = 'C41';
        } elseif (($r->penghasilan >= 1500000) and ($r->penghasilan <= 3000000)) {
            $penghasilan = 'C42';
        } elseif (($r->penghasilan >= 3000000) and ($r->penghasilan <= 4500000)) {
            $penghasilan = 'C43';
        } elseif ($r->penghasilan > 4500000) {
            $penghasilan = 'C44';
        }
        
        $relasi = new RelasiTabel;
        $relasi->id_siswa = $siswa->id;
        $relasi->umur = $umur;
        $relasi->jarak_sekolah = $jarak;
        $relasi->potensi_akademik = $potensi;
        $relasi->penghasilan_orang_tua = $penghasilan;
        $simpan = $relasi->save();
 
        if($simpan){
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            Session::flash('errors', ['' => 'Data Gagal Ditambahkan! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back();
        }
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show',compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        //
    }

    public function update(Request $r, Siswa $siswa)
    {
        $rules = [
            'nama'               => 'required|max:100',
            'potensi'            => 'required',
            'tanggal_lahir'      => 'required',
            'alamat'             => 'required',
            'jenis_kelamin'      => 'required',
            'penghasilan'        => 'required',
            'jarak_rumah'        => 'required',
        ];
 
        $messages = [
            'nama.required'         => 'Nama wajib diisi',
            'nama.max'              => 'Nama maksimal 100 karakter',
            'tanggal_lahir.required'    => 'Tanggal Lahir wajib diisi',
            'potensi.required'      => 'Potensi wajib diisi',
            'alamat.required'       => 'Alamat wajib diisi',
            'penghasilan.required'  => 'Penghasilan wajib diisi',
            'jarak_rumah.required'  => 'Jarak Rumah wajib diisi',
        ];

        $years = Carbon::parse($r->tanggal_lahir)->age;

        if ($years < 6) {
            Session::flash('error', 'Data Gagal Ditambahkan! Umur Siswa Minimal 6 Tahun');
            return redirect()->back()->withInput($r->all());;
        }

        $validator = Validator::make($r->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($r->all());
        }

        $siswa = Siswa::find($r->id);
        
        $siswa->update([
            'nama_siswa' => $r->nama,
            'jenis_kelamin' => $r->jenis_kelamin,
            'alamat' => $r->alamat,
            'umur' => $years,
            'tanggal_lahir' => $r->tanggal_lahir,
            'jarak_sekolah' => $r->jarak_rumah,
            'potensi_akademik' => $r->potensi,
            'penghasilan_orang_tua' => $r->penghasilan,
        ]);
        
        if ($r->foto != null) {
            $r->foto->store('siswa/foto', 'public');
            $siswa->update([
                'foto_anak' => $r->foto->hashName(),
            ]);
        }

        if ($r->foto_kk != null) {
            $r->foto_kk->store('siswa/kk', 'public');
            $siswa->update([
                'foto_kk' => $r->foto_kk->hashName(),
            ]);
        }

        if ($r->foto_kk != null) {
            $r->foto_akta->store('siswa/akta_kelahiran', 'public');
            $siswa->update([
                'akta_kelahiran' => $r->foto_akta->hashName(),
            ]);
        }
        
        if ($siswa->umur <= 6) {
            $umur = 'C11';
        } elseif ($siswa->umur == 7) {
            $umur = 'C12';
        } elseif ($siswa->umur == 8) {
            $umur = 'C13';
        } elseif ($siswa->umur > 8) {
            $umur = 'C14';
        }

        if ($siswa->jarak_sekolah < 2) {
            $jarak = 'C21';
        } elseif (($siswa->jarak_sekolah >= 2) and ($siswa->jarak_sekolah <= 5.9)) {
            $jarak = 'C22';
        } elseif (($siswa->jarak_sekolah >= 6) and ($siswa->jarak_sekolah <= 10)) {
            $jarak = 'C23';
        } elseif ($siswa->jarak_sekolah > 10) {
            $jarak = 'C24';
        }
        
        if ($siswa->potensi_akademik == "Kurang Berpotensi") {
            $potensi = 'C31';
        } elseif ($siswa->potensi_akademik == "Cukup Berpotensi") {
            $potensi = 'C32';
        } elseif ($siswa->potensi_akademik == "Berpotensi") {
            $potensi = 'C33';
        } elseif ($siswa->potensi_akademik == "Sangat Berpotensi") {
            $potensi = 'C34';
        }

        if ($siswa->penghasilan_orang_tua < 1500000) {
            $penghasilan = 'C41';
        } elseif (($siswa->penghasilan_orang_tua >= 1500000) and ($siswa->penghasilan_orang_tua <= 3000000)) {
            $penghasilan = 'C42';
        } elseif (($siswa->penghasilan_orang_tua >= 3000000) and ($siswa->penghasilan_orang_tua <= 4500000)) {
            $penghasilan = 'C43';
        } elseif ($siswa->penghasilan_orang_tua > 4500000) {
            $penghasilan = 'C44';
        }
        
        $relasi = RelasiTabel::where('id_siswa',$siswa->id)->first();
               
        $relasi->update([
            'id_siswa' => $siswa->id,
            'umur' => $umur,
            'jarak_sekolah' => $jarak,
            'potensi_akademik' => $potensi,
            'penghasilan_orang_tua' => $penghasilan,
        ]);
        
        return redirect()->back()->with('success', 'Data Berhasil Diperbarui');
    }

    public function delete($id){
        Siswa::destroy($id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
