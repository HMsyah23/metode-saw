<?php

namespace App\Http\Controllers;

use PDF;
use App\Kriteria;
use App\Subkriteria;
use App\Siswa;
use App\RelasiTabel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
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

    
    public function laporanRanking(){

        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

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
                 'jk' => $collect->siswa->jenis_kelamin,
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
                 'jk' => $collect->jk,
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
                 'jk' => $collect->jk,
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
                 'jk' => $collect->jk,
                 'hasil' => $collect->C1 + $collect->C2 + $collect->C3 + $collect->C4,
            ];
        });

        $hasil = collect($hasil)->sortBy('hasil')->reverse();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.ranking',compact('hasil','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}

    public function laporanSiswa($id)
	{
		$siswa = Siswa::find($id);
        $path = 'images/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		$pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('laporan.siswa',compact('siswa','base64'))
        // ->setOptions(['isPhpEnabled' => true])
        ->setPaper('a4', 'portrait');
        return $pdf->stream();
	}
}
