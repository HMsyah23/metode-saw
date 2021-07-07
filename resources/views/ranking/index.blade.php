@extends('layouts.app', 
    [
        'title' => 'Perankingan Calon Siswa',
        'keterangan' => 'Data Calon Siswa yang sudah Diranking berdasarkan metode SAW',
        'icon' => 'pe-7s-users'
    ])

@section('tombol')
@if(Auth::user()->role == 0)
    <a href="{{route('laporan.ranking')}}" class="btn-shadow mr-3 btn btn-dark">
        <i class="fa fa-print"> Cetak Laporan</i>
    </a>
    @endif
    <a href="{{route('ranking.saw')}}" class="btn-shadow mr-3 btn btn-primary">
        <i class="fa fa-eye"> Detail Perhitungan SAW</i>
    </a>
@endsection


@section('content') 
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Ranking</h5>
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
                            @if(Auth::user()->role == 0)
                            <th>Aksi</th>
                            @endif
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
                                @if(Auth::user()->role == 0)
                                <td>
                                    {{-- <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$siswa->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button> --}}
                                        <a href="{{route('laporan.siswa',$siswa['id'])}}" class="btn btn-sm btn-warning rounded-rounded"> <i class="fas fa-print"></i></a>
                                    {{-- <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$siswa->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button> --}}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  


@push('js')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
        function myFunction() {
            var x = document.getElementById("myInput");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
        }
    </script>
@endpush