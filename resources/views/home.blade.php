@extends('layouts.app', [
    'title' => 'Dashboard',
    'keterangan' => 'SPK Penerimaan Siswa Baru Pada SD Negeri 004 Sanggata Utara',
    'icon' => 'pe-7s-home'
    ])

@section('content')
<div class="row">
    <div class="col-md-6 col-xl-6 col-lg-4">
        <a href="{{route('siswa.index')}}">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Siswa</div>
                        <div class="widget-subheading">Jumlah Siswa Yang Mendaftar</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$siswas->count()}}</span></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-6 col-lg-4">
        <a href="{{route('kriteria.index')}}">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Kriteria</div>
                    <div class="widget-subheading"></div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{$kriterias->count()}}</span></div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-6 col-lg-4">
        <a href="{{route('ranking.index')}}">
        <div class="card mb-3 widget-content bg-premium-dark">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Perankingan</div>
                    <div class="widget-subheading">Ranking Calon Siswa Baru </div>
                </div>
                <div class="widget-content-right">
                    <!-- <div class="widget-numbers text-warning"><span>$14M</span></div> -->
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-6 col-lg-4">
        <a href="{{route('user')}}">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Data Pengguna</div>
                        <div class="widget-subheading">Pengguna yang dapat mengakses sistem</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$users->count()}}</span></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection