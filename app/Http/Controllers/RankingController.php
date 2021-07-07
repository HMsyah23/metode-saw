<?php

namespace App\Http\Controllers;

use App\Kriteria;
use App\Subkriteria;
use App\Siswa;
use App\RelasiTabel;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class RankingController extends Controller
{

    public function index()
    {
        $collection = RelasiTabel::all();
        $umur = Kriteria::where('kode','C1')->first();
        $jarak = Kriteria::where('kode','C2')->first();
        $potensi = Kriteria::where('kode','C3')->first();
        $penghasilan = Kriteria::where('kode','C4')->first();
        // Tahap Analisa
        $data = collect($collection)->map(function($collection, $key) {
            $collect = (object)$collection;
            return [
                 'id' => $collect->siswa->id,
                 'nama' => $collect->siswa->nama_siswa,
                 'alamat' => $collect->siswa->alamat,
                 'umur' => $collect->siswa->umur,
                 'jarak' => $collect->siswa->jarak_sekolah,
                 'potensi' => $collect->siswa->potensi_akademik,
                 'penghasilan' => $collect->siswa->penghasilan_orang_tua,
                 'C1' => $this->ganti_nilai($collect->umur),
                 'C2' => $this->ganti_nilai($collect->jarak_sekolah),
                 'C3' => $this->ganti_nilai($collect->potensi_akademik),
                 'C4' => $this->ganti_nilai($collect->penghasilan_orang_tua),
            ];
        });
     

       // Tahap Normalisasi
        $data2 = $data;
        $normalisasi = collect($data)->map(function($data, $key) use ($data2, $umur,$jarak,$potensi,$penghasilan) {
            $collect = (object)$data;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'C1' => $this->normalisasi($umur,$collect->C1,$data2),
                 'C2' => $this->normalisasi($jarak,$collect->C2,$data2),
                 'C3' => $this->normalisasi($potensi,$collect->C3,$data2),
                 'C4' => $this->normalisasi($penghasilan,$collect->C4,$data2),
            ];
        });

        //Tahap Perankingan
        $ranking = collect($normalisasi)->map(function($normalisasi, $key) use ($umur,$jarak,$potensi,$penghasilan) {
            $collect = (object)$normalisasi;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'C1' => $this->ranking($umur,$collect->C1),
                 'C2' => $this->ranking($jarak,$collect->C2),
                 'C3' => $this->ranking($potensi,$collect->C3),
                 'C4' => $this->ranking($penghasilan,$collect->C4),
            ];
        });

        $hasil = collect($ranking)->map(function($ranking, $key) {
            $collect = (object)$ranking;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'hasil' => $collect->C1 + $collect->C2 + $collect->C3 + $collect->C4,
            ];
        });

        $hasil = collect($hasil)->sortBy('hasil')->reverse();

        return view('ranking.index',compact('hasil'));
    }


    public function ganti_nilai($key) {
        $item = Subkriteria::where('kode',$key)->first()->nilai;
        return $item;
    }

    public function normalisasi($c,$nilai,$data) {
        if ($c->tipe == "benefit") {
            $max = $data->max($c->kode);
            $item = $nilai / $max;
        } else {
            $min = $data->min($c->kode);
            $item = $min / $nilai;
        }
        return number_format($item,2);
    }

    public function cara_normalisasi($c,$nilai,$data) {
        if ($c->tipe == "benefit") {
            $max = $data->max($c->kode);
            $item = $nilai / $max;
            return $nilai.' / '.$max.' = '.number_format($item,2);
        } else {
            $min = $data->min($c->kode);
            $item = $min / $nilai;
            return $min.' / '.$nilai.' = '.number_format($item,2);
        }
    }

    public function ranking($c,$nilai) {
        $item = $nilai * ($c->bobot * 100);
        return number_format($item,2);
    }

    public function cara_ranking($c,$nilai) {
        $item = $nilai * ($c->bobot * 100);
        return "(".$nilai." x ".($c->bobot * 100)." = ".number_format($item,2).")";
    }

    public function saw()
    {
        $collection = RelasiTabel::all();
        $siswas = Siswa::all();
        $kriterias = Kriteria::all();
        $umur = Kriteria::where('kode','C1')->first();
        $jarak = Kriteria::where('kode','C2')->first();
        $potensi = Kriteria::where('kode','C3')->first();
        $penghasilan = Kriteria::where('kode','C4')->first();
        // Tahap Analisa
        $data = collect($collection)->map(function($collection, $key) {
            $collect = (object)$collection;
            return [
                 'id' => $collect->siswa->id,
                 'nama' => $collect->siswa->nama_siswa,
                 'alamat' => $collect->siswa->alamat,
                 'umur' => $collect->siswa->umur,
                 'jarak' => $collect->siswa->jarak_sekolah,
                 'potensi' => $collect->siswa->potensi_akademik,
                 'penghasilan' => $collect->siswa->penghasilan_orang_tua,
                 'C1' => $this->ganti_nilai($collect->umur),
                 'C2' => $this->ganti_nilai($collect->jarak_sekolah),
                 'C3' => $this->ganti_nilai($collect->potensi_akademik),
                 'C4' => $this->ganti_nilai($collect->penghasilan_orang_tua),
            ];
        });
     

       // Tahap Normalisasi
        $data2 = $data;
        $normalisasi = collect($data)->map(function($data, $key) use ($data2, $umur,$jarak,$potensi,$penghasilan) {
            $collect = (object)$data;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'C1' => $this->normalisasi($umur,$collect->C1,$data2),
                 'C2' => $this->normalisasi($jarak,$collect->C2,$data2),
                 'C3' => $this->normalisasi($potensi,$collect->C3,$data2),
                 'C4' => $this->normalisasi($penghasilan,$collect->C4,$data2),
            ];
        });

        $normalisasi2 = collect($data)->map(function($data, $key) use ($data2, $umur,$jarak,$potensi,$penghasilan) {
            $collect = (object)$data;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'C1' => $this->cara_normalisasi($umur,$collect->C1,$data2),
                 'C2' => $this->cara_normalisasi($jarak,$collect->C2,$data2),
                 'C3' => $this->cara_normalisasi($potensi,$collect->C3,$data2),
                 'C4' => $this->cara_normalisasi($penghasilan,$collect->C4,$data2),
            ];
        });

        //Tahap Perankingan
        $ranking = collect($normalisasi)->map(function($normalisasi, $key) use ($umur,$jarak,$potensi,$penghasilan) {
            $collect = (object)$normalisasi;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'C1' => $this->ranking($umur,$collect->C1),
                 'C2' => $this->ranking($jarak,$collect->C2),
                 'C3' => $this->ranking($potensi,$collect->C3),
                 'C4' => $this->ranking($penghasilan,$collect->C4),
            ];
        });

        $ranking2 = collect($normalisasi)->map(function($normalisasi, $key) use ($umur,$jarak,$potensi,$penghasilan) {
            $collect = (object)$normalisasi;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'keterangan' => $this->cara_ranking($umur,$collect->C1).' + '.
                                    $this->cara_ranking($jarak,$collect->C2).' + '.
                                    $this->cara_ranking($potensi,$collect->C3).' + '.
                                    $this->cara_ranking($penghasilan,$collect->C4),
                'hasil' => ($this->ranking($umur,$collect->C1)+$this->ranking($jarak,$collect->C2)+$this->ranking($potensi,$collect->C3)+$this->ranking($penghasilan,$collect->C4)),
            ];
        });

        $hasil = collect($ranking)->map(function($ranking, $key) {
            $collect = (object)$ranking;
            return [
                 'id' => $collect->id,
                 'nama' => $collect->nama,
                 'alamat' => $collect->alamat,
                 'umur' => $collect->umur,
                 'jarak' => $collect->jarak,
                 'potensi' => $collect->potensi,
                 'penghasilan' => $collect->penghasilan,
                 'hasil' => $collect->C1 + $collect->C2 + $collect->C3 + $collect->C4,
            ];
        });

        $hasil = collect($hasil)->sortBy('hasil')->reverse();
        $subkriterias = Subkriteria::all();
        $kriterias = kriteria::all();
        return view('ranking.saw',compact('ranking2','data','normalisasi','normalisasi2','ranking','hasil','kriterias','subkriterias','siswas','kriterias'));
    }


}
