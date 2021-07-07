@extends('layouts.app', 
    [
        'title' => 'Detail Perhitungan SAW',
        'keterangan' => 'Detail Proses Perhitungan SAW',
        'icon' => 'pe-7s-users'
    ])

@section('tombol')
    <a href="{{route('laporan.ranking')}}" class="btn-shadow mr-3 btn btn-dark">
        <i class="fa fa-print"> Cetak Laporan</i>
    </a>
    <a href="{{route('ranking.saw')}}" class="btn-shadow mr-3 btn btn-primary">
        <i class="fa fa-arrow-left"> Ranking Siswa</i>
    </a>
@endsection


@section('content') 
<div class="row">
    <div class="col-lg-12" style="display:none;">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Persiapan Data</h5>
                <div id="accordion" class="accordion-wrapper mb-3">
                    <div class="card">
                        <div id="headingOne" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">1. Menentukan Data Kriteria</h5>
                            </button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode </th>
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>Bobot</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriterias as $kriteria)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$kriteria->kode}}</td>
                                                <td>{{$kriteria->nama}}</td>
                                                <td>{{$kriteria->tipe}}</td>
                                                <td>{{$kriteria->bobot}} ({{$kriteria->bobot*100}}%)</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingTwo" class="b-radius-0 card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">2. Menentukan Data Subkriteria</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne2" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Kriteria</th>
                                            <th>Kode Sub Kriteria</th>
                                            <th>Nama</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subkriterias as $subkriteria)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$subkriteria->kriteria->kode}}</td>
                                                <td>{{$subkriteria->kode}}</td>
                                                <td>{{$subkriteria->kriteria->nama}}</td>
                                                <td>{{$subkriteria->kondisi}}</td>
                                                <td>{{$subkriteria->nilai}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">3. Menentukan Data Alternatif (Data Para Calon Siswa)</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne3" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Umur</th>
                                            <th>Jarak Sekolah</th>
                                            <th>Potensi Akademik</th>
                                            <th>Penghasilan Orang Tua</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($siswas as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa->nama_siswa}}</td>
                                                <td>{{$siswa->umur}} Tahun</td>
                                                <td>{{$siswa->jarak_sekolah}}/Km</td>
                                                <td>{{$siswa->potensi_akademik}}</td>
                                                <td>Rp. {{$siswa->penghasilan_orang_tua}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">4. Mengambil Nilai Dari Data Alternatif (Data Para Calon Siswa)</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne4" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Umur (C1)</th>
                                            <th>Jarak Sekolah (C2)</th>
                                            <th>Potensi Akademik (C3)</th>
                                            <th>Penghasilan Orang Tua (C4)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa['nama']}}</td>
                                                <td>{{$siswa['C1'] ?? ''}}</td>
                                                <td>{{$siswa['C2'] ?? ''}}</td>
                                                <td>{{$siswa['C3'] ?? ''}}</td>
                                                <td>{{$siswa['C4'] ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Persiapan Data</h5>
                <div id="accordion" class="accordion-wrapper mb-3">
                    <div class="card">
                        <div id="headingOne" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">1. Menentukan Data Kriteria</h5>
                            </button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode </th>
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>Bobot</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriterias as $kriteria)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$kriteria->kode}}</td>
                                                <td>{{$kriteria->nama}}</td>
                                                <td>{{$kriteria->tipe}}</td>
                                                <td>{{$kriteria->bobot}} ({{$kriteria->bobot*100}}%)</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingTwo" class="b-radius-0 card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">2. Menentukan Data Subkriteria</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne2" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Kriteria</th>
                                            <th>Kode Sub Kriteria</th>
                                            <th>Nama</th>
                                            <th>Kondisi</th>
                                            <th>Nilai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subkriterias as $subkriteria)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$subkriteria->kriteria->kode}}</td>
                                                <td>{{$subkriteria->kode}}</td>
                                                <td>{{$subkriteria->kriteria->nama}}</td>
                                                <td>{{$subkriteria->kondisi}}</td>
                                                <td>{{$subkriteria->nilai}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">3. Menentukan Data Alternatif (Data Para Calon Siswa)</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne3" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Umur</th>
                                            <th>Jarak Sekolah</th>
                                            <th>Potensi Akademik</th>
                                            <th>Penghasilan Orang Tua</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($siswas as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa->nama_siswa}}</td>
                                                <td>{{$siswa->umur}} Tahun</td>
                                                <td>{{$siswa->jarak_sekolah}}/Km</td>
                                                <td>{{$siswa->potensi_akademik}}</td>
                                                <td>Rp. {{$siswa->penghasilan_orang_tua}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">4. Mengambil Nilai Dari Data Alternatif (Data Para Calon Siswa)</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne4" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Umur (C1)</th>
                                            <th>Jarak Sekolah (C2)</th>
                                            <th>Potensi Akademik (C3)</th>
                                            <th>Penghasilan Orang Tua (C4)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa['nama']}}</td>
                                                <td>{{$siswa['C1'] ?? ''}}</td>
                                                <td>{{$siswa['C2'] ?? ''}}</td>
                                                <td>{{$siswa['C3'] ?? ''}}</td>
                                                <td>{{$siswa['C4'] ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Perhitungan SAW</h5>
                <div id="accordion" class="accordion-wrapper mb-3">
                    <div class="card">
                        <div id="headingOne" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">1. Tahap Analisa</h5>
                            </button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne5" aria-labelledby="headingOne" class="collapse">
                            <div class="card-body">
                                <h6 class="text-muted"><strong>Daftar Data Alternatif (Data Calon Siswa) yang akan digunakan dalam perhitungan SAW :</strong></h6>
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Umur (C1)</th>
                                            <th>Jarak Sekolah (C2)</th>
                                            <th>Potensi Akademik (C3)</th>
                                            <th>Penghasilan Orang Tua (C4)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa['nama']}}</td>
                                                <td>{{$siswa['C1'] ?? ''}}</td>
                                                <td>{{$siswa['C2'] ?? ''}}</td>
                                                <td>{{$siswa['C3'] ?? ''}}</td>
                                                <td>{{$siswa['C4'] ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingTwo" class="b-radius-0 card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">2. Tahap Normalisasi</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne6" class="collapse">
                            <div class="card-body">
                                <h6 class="text-muted mt-3"><strong>Mencari Nilai Min Dan Max Dari Kumpulan Data Alternatif : </strong></h6>
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Tipe</th>
                                                <th>Nilai</th>
                                                <th>Max</th>
                                                <th>Min</th>
                                            </tr>
                                        </thead>
                                        @foreach ($kriterias as $kriteria)
                                        <tr>
                                            <td>{{$kriteria->kode}}</td>
                                            <td>{{$kriteria->nama}}</td>
                                            <td>{{$kriteria->tipe}}</td>
                                            <td>
                                                @php
                                                    $jumlah = array();
                                                @endphp
                                                ( @foreach ($data as $siswa => $value )
                                                    {{$value[$kriteria->kode]}},
                                                    @php
                                                       array_push($jumlah, $value[$kriteria->kode]);
                                                    @endphp
                                                @endforeach)
                                            </td>
                                                <td>{{max($jumlah)}}</td>
                                                <td>{{min($jumlah)}}</td>
                                        </tr>
                                        @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <h6 class="text-muted mt-3"><strong>Langkah Normalisasi: </strong></h6>
                                <h6 class="text-muted mt-3">Rumus Normalisasi </h6>
                                <img src="{{asset('images/Normalisasi-SAW.png')}}" alt="">
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>C1</th>
                                            <th>C2</th>
                                            <th>C3</th>
                                            <th>C4</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($normalisasi2 as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa['nama']}}</td>
                                                <td>{{$siswa['C1'] ?? ''}}</td>
                                                <td>{{$siswa['C2'] ?? ''}}</td>
                                                <td>{{$siswa['C3'] ?? ''}}</td>
                                                <td>{{$siswa['C4'] ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <h6 class="text-muted mt-3"><strong>Perhitungan Dengan Bobot : </strong></h6>
                                    <table id="myTable" class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Perhitungan (C1 * Bobot) + (C2 * Bobot) + (C3 * Bobot) + (C4 * Bobot)</th>
                                            <th>Skor</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($ranking2 as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa['nama']}}</td>
                                                <td>{{$siswa['keterangan'] ?? ''}}</td>
                                                <td>{{$siswa['hasil'] ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne7" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <h5 class="m-0 p-0">3. Tahap Perankingan</h5></button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne7" class="collapse">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>Alamat</th>
                                            <th>Umur</th>
                                            <th>Jarak Sekolah</th>
                                            <th>Potensi Akademik</th>
                                            <th>Penghasilan Orang Tua</th>
                                            <th>Skor</th>
                                            <th>Cetak</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($hasil as $siswa)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$siswa['nama']}}</td>
                                                <td>{{$siswa['alamat'] ?? ''}}</td>
                                                <td>{{$siswa['umur'] ?? ''}} Tahun</td>
                                                <td>{{$siswa['jarak'] ?? ''}}/Km</td>
                                                <td>{{$siswa['potensi'] ?? ''}}</td>
                                                <td>Rp. {{$siswa['penghasilan'] ?? ''}}</td>
                                                <td>{{$siswa['hasil'] ?? ''}}</td>
                                                <td>
                                                    {{-- <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$siswa->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button> --}}
                                                        <a href="{{route('siswa.show',$siswa['id'])}}" class="btn btn-sm btn-warning rounded-rounded"> <i class="fas fa-print"></i></a>
                                                    {{-- <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$siswa->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  
