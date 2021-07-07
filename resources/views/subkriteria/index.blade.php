@extends('layouts.app', 
    [
        'title' => 'Data Sub Kriteria',
        'keterangan' => 'Data Sub Kriteria dari Kriteria Penilaian',
        'icon' => 'pe-7s-science'
    ])

@section('tombol')
    {{-- <button type="button" title="Tambah Data" data-placement="bottom" data-toggle="modal" data-target="#modalTambah" class="btn-shadow mr-3 btn btn-primary">
        <i class="fa fa-plus-circle"> Tambah Data</i>
    </button> --}}
@endsection

@section('content') 
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body"><h5 class="card-title">Daftar Sub Kriteria</h5>
                <div class="table-responsive">
                    <table id="myTable" class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Kriteria</th>
                            <th>Kode Sub Kriteria</th>
                            <th>Nama</th>
                            <th>Kondisi</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
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
                                <td>
                                    {{-- <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$subkriteria->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button> --}}
                                        <button class="btn btn-sm btn-warning rounded-rounded" data-toggle="modal" data-target="#editModal-{{$subkriteria->id}}" data-backdrop="static"> <i class="fas fa-edit"></i></button>
                                    {{-- <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$subkriteria->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button> --}}
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
<form action="{{ route('subkriteria.store') }}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> <i class="fas fa-user"></i> Tambah Data Sub Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                 <label for="exampleAddress2" class="">Kode</label>
                                 <input name="kodeSub" placeholder="Masukkan Kode Sub Kriteria" type="text" class="form-control">
                            </div>
                         </div>
                        <div class="col-md-12">
                           <div class="position-relative form-group">
                            <div class="position-relative form-group"><label for="kode" class="">Kode Kriteria</label>
                                <select type="select" id="exampleCustomSelect" name="kode" class="custom-select">
                                    @foreach ($kriterias as $kriteria)
                                        <option value="{{$kriteria->id}}">{{$kriteria->kode}}</option>
                                    @endforeach
                                </select>
                            </div>
                           </div>
                        </div>
                        <div class="col-md">
                            <div class="position-relative form-group"><label class="">Kondisi</label><input name="kondisi" placeholder="Masukkan Nama" type="nama" class="form-control"></div>
                            </div>
                    </div>    
                    <div class="form-row">
                        <div class="col-md">
                            <div class="position-relative form-group"><label for="exampleCity" class="">Nilai</label>
                                <input class="form-control" type="number" name="nilai" min="1" max="100">   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

    @foreach ($subkriterias as $subkriteria)
    <form action="{{ route('subkriteria.update',$subkriteria->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="modal fade bd-example-modal-lg" id="editModal-{{$subkriteria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                <h6 class="modal-title text-white" id="exampleModalLabel"> <i class="fa fa-pen"></i> Ubah Data </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md">
                            <div class="position-relative form-group"><label for="exampleCity" class="">Bobot</label>
                                <input class="form-control" type="number" name="nilai-{{$subkriteria->id}}" min="1" max="100" step="1" value="{{$subkriteria->nilai}}">   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
            </div>
        </div>
    </form>
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