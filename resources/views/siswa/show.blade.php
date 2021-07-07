@extends('layouts.app', 
    [
        'title' => 'Detail Siswa',
        'keterangan' => 'Detail Informasi Siswa',
        'icon' => 'pe-7s-users'
    ])

@section('tombol')
    <a href="{{route('laporan.siswa',$siswa->id)}}" data-toggle="tooltip" title="Cetak Laporan" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
        <i class="fa fa-print"> Cetak Laporan</i>
    </a>
    <a href="{{route('siswa.index')}}" type="button" class="btn-shadow mr-3 btn btn-primary">
        <i class="fa fa-arrow-left"> Kembali</i>
    </a>
@endsection

@section('content') 
<div class="row">
    <div class="col-lg-2">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Nama Siswa : {{$siswa->nama_siswa}}
                </h5>
                <img src="{{ url('public/siswa/foto/'.$siswa->foto_anak) }}" class="rounded mx-auto d-block mb-3" alt="Foto 3 x 4" style="width: 50%; height:50%;">
                </a>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <a type="button" href="{{ url('public/siswa/akta_kelahiran/'.$siswa->akta_kelahiran)}}" class="mb-2 btn btn-sm btn-primary"> <i class="fas fa-file-pdf"></i> Akta Kelahiran</a>
                    <a type="button" href="{{ url('public/siswa/kk/'.$siswa->foto_kk)}}" class="mb-2 btn btn-sm btn-alternate"> <i class="fas fa-file-pdf"></i> Foto KK</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="main-card mb-3 card">
            <div class="card-body">
            <form action="{{ route('siswa.update',$siswa->id) }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-12">
                            <div class="position-relative form-group"><label for="exampleAddress2" class="">Nama Siswa</label><input name="nama" id="exampleAddress2" placeholder="Nama Siswa" type="text" class="form-control" value="{{$siswa->nama_siswa}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="position-relative form-group"><label for="exampleAddress2" class="">NIK</label><input name="nik" id="exampleAddress2" placeholder="NIK Siswa" type="text" class="form-control" value="{{$siswa->nik}}" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="position-relative form-group"><label for="exampleEmail11" class="">Tanggal Lahir</label><input name="tanggal_lahir" id="exampleEmail11" placeholder="Tanggal Lahir" type="date" class="form-control" value="{{ $siswa->tanggal_lahir->format('Y-m-d') }}"></div>

                        </div>
                        <div class="col-2">
                            <div class="position-relative form-group"><label for="exampleEmail11" class="">Umur <sub>(Tahun)</sub></label><input disabled name="umur" id="exampleEmail11" placeholder="Umur" type="number" class="form-control" min="1" max="15" step="1" value="{{$siswa->umur}}"></div>
                        </div>
                        <div class="col-2">
                            <div class="position-relative form-group"><label for="examplePassword11" class="">Jenis Kelamin</label>
                                <select type="select" id="exampleCustomSelect" name="jenis_kelamin" class="custom-select">
                                    <option @if ($siswa->jenis_kelamin == 0)
                                        selected
                                    @endif value="0">Laki - Laki</option>
                                    <option @if ($siswa->jenis_kelamin == 1)
                                        selected
                                    @endif value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative form-group"><label for="exampleAddress" class="">Alamat</label><input name="alamat" id="exampleAddress" placeholder="Masukkan Alamat" type="text" class="form-control" value="{{$siswa->alamat}}"></div>
                    
                    <div class="form-row">
                        <div class="col-4">
                            <div class="position-relative form-group"><label for="examplePassword11" class="">Potensi Akademik</label>
                                <select type="select" id="exampleCustomSelect" name="potensi" class="custom-select">
                                    <option @if ($siswa->potensi_akademik == "Sangat Berpotensi")
                                        selected
                                    @endif value="Sangat Berpotensi">Sangat Berpotensi</option>
                                    <option @if ($siswa->potensi_akademik == "Berpotensi")
                                        selected
                                    @endif value="Berpotensi">Berpotensi</option>
                                    <option @if ($siswa->potensi_akademik == "Cukup Berpotensi")
                                        selected
                                    @endif value="Cukup Berpotensi">Cukup Berpotensi</option>
                                    <option @if ($siswa->potensi_akademik == "Kurang Berpotensi")
                                        selected
                                    @endif value="Kurang Berpotensi">Kurang Berpotensi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="position-relative form-group">
                                <label for="exampleState" class="">Penghasilan Orang Tua <sub>(Rp.)</sub></label>
                                <input name="penghasilan" type="number" class="form-control" value="{{$siswa->penghasilan_orang_tua}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="position-relative form-group">
                                <label for="exampleZip" class="">Jarak Rumah <sub>(Km)</sub></label>
                                <input name="jarak_rumah" type="number" class="form-control" value="{{$siswa->jarak_sekolah}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="position-relative row form-group">
                                <label for="exampleFile" class="col-sm-2 col-form-label">Upload Foto</label>
                                <div class="col-sm-10">
                                    <input name="foto" type="file" class="form-control-file">
                                    <small class="form-text text-muted">Upload Foto Berseragam ukuran 3 x 4 dengan latar belakang berwarna merah</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="position-relative row form-group">
                                <label for="exampleFile" class="col-sm-2 col-form-label">Upload Foto Kartu Keluarga</label>
                                <div class="col-sm-10">
                                    <input name="foto_kk" type="file" class="form-control-file">
                                    <small class="form-text text-muted">Upload Foto Kartu Keluarga (KK)</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="position-relative row form-group">
                                <label for="exampleFile" class="col-sm-2 col-form-label">Upload File Akta Kelahiran</label>
                                <div class="col-sm-10">
                                    <input name="foto_akta" type="file" class="form-control-file">
                                    <small class="form-text text-muted">Upload Akta Kelahiran Siswa</small>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{-- <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Tutup</button> --}}
                <input type="hidden" name="id" value="{{$siswa->id}}">
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </div>
    </form>
    </div>
</div>

@endsection   
                        