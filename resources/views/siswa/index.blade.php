@extends('layouts.app', 
    [
        'title' => 'Data Calon Siswa',
        'keterangan' => 'Data Calon Siswa yang akan mendaftar pada SD Negeri 004',
        'icon' => 'pe-7s-users'
    ])

@section('tombol')
    <button type="button" title="Tambah Data" data-placement="bottom" data-toggle="modal" data-target="#modalTambah" class="btn-shadow mr-3 btn btn-primary">
        <i class="fa fa-plus-circle"> Tambah Data</i>
    </button>
@endsection


@section('content') 
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">List Data Calon Siswa</h5>
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
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($siswas as $siswa)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$siswa->nama_siswa}}</td>
                                <td>{{$siswa->alamat}}</td>
                                <td>{{$siswa->umur}} Tahun</td>
                                <td>{{$siswa->jarak_sekolah}}/Km</td>
                                <td>{{$siswa->potensi_akademik}}</td>
                                <td>Rp. {{$siswa->penghasilan_orang_tua}}</td>
                                <td>
                                    {{-- <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$siswa->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button> --}}
                                        <a href="{{route('siswa.show',$siswa->id)}}" class="btn btn-sm btn-warning rounded-rounded"> <i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$siswa->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button>
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
@endsection  

@section('modal')
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <i class="fas fa-users"></i> Tambah Data Calon Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="card-body"><h5 class="card-title">Grid Rows</h5> -->
                    <form action="{{ route('siswa.store') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12">
                                <div class="position-relative form-group"><label for="exampleAddress2" class="">Nama Siswa</label><input name="nama" id="exampleAddress2" placeholder="Nama Siswa" type="text" class="form-control" value="{{old('nama')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="position-relative form-group"><label for="exampleAddress2" class="">NIK</label><input name="nik" id="exampleAddress2" placeholder="NIK Siswa" type="text" class="form-control" value="{{old('nik')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="position-relative form-group"><label for="exampleEmail11" class="">Tanggal Lahir</label><input name="tanggal_lahir" id="exampleEmail11" placeholder="Tanggal Lahir" type="date" class="form-control"></div>
                            </div>
                            <div class="col-4">
                                <div class="position-relative form-group"><label for="examplePassword11" class="">Jenis Kelamin</label>
                                    <select type="select" id="exampleCustomSelect" name="jenis_kelamin" class="custom-select">
                                        <option value="0">Laki - Laki</option>
                                        <option value="1">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="position-relative form-group"><label for="exampleAddress" class="">Alamat</label><input name="alamat" id="exampleAddress" placeholder="Masukkan Alamat" type="text" class="form-control" value="{{old('alamat')}}"></div>
                        
                        <div class="form-row">
                            <div class="col-4">
                                <div class="position-relative form-group"><label for="examplePassword11" class="">Potensi Akademik</label>
                                    <select type="select" id="exampleCustomSelect" name="potensi" class="custom-select">
                                        <option value="Sangat Berpotensi" selected>Sangat Berpotensi</option>
                                        <option value="Berpotensi">Berpotensi</option>
                                        <option value="Cukup Berpotensi">Cukup Berpotensi</option>
                                        <option value="Kurang Berpotensi">Kurang Berpotensi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="position-relative form-group">
                                    <label for="exampleState" class="">Penghasilan Orang Tua <sub>(Rp.)</sub></label>
                                    <input name="penghasilan" type="number" class="form-control" value="{{old('penghasilan')}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="position-relative form-group">
                                    <label for="exampleZip" class="">Jarak Rumah <sub>(Km)</sub></label>
                                    <input name="jarak_rumah" type="number" class="form-control" value="{{old('jarak_rumah')}}">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
            </div>
        </div>
    </div>
</div>

@foreach ($siswas as $siswa)
    <div class="modal fade bd-example-modal-lg" id="deleteModal-{{$siswa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h6 class="modal-title text-white" id="exampleModalLabel"> <i class="fa fa-trash"></i> Yakin menghapus Data {{$siswa->nama_siswa}} ?</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <form action="{{ route('siswa.destroy',$siswa->id) }}" method="POST">
                @csrf
                    <button type="submit" class="btn btn-danger"> <i class="fa fa-check"></i> Iya</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times"></i> Tidak</button>
            </div>
        </div>
        </div>
    </div>
    @endforeach
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