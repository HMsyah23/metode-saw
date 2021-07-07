@extends('layouts.app', 
    [
        'title' => 'Data Kriteria',
        'keterangan' => 'Data kriteria yang akan dijadikan sebagai parameter penilaian',
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
            <div class="card-body"><h5 class="card-title">Daftar Kriteria</h5>
                <div class="table-responsive">
                    <table id="myTable" class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode </th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
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
                                <td>
                                    {{-- <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$kriteria->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button> --}}
                                        <button class="btn btn-sm btn-warning rounded-rounded" data-toggle="modal" data-target="#editModal-{{$kriteria->id}}" data-backdrop="static"> <i class="fas fa-edit"></i></button>
                                    {{-- <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$kriteria->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button> --}}
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
<form action="{{ route('kriteria.store') }}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> <i class="fas fa-user"></i> Tambah Data Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                           <div class="position-relative form-group">
                                <label for="exampleAddress2" class="">Kode</label>
                                <input name="kode" id="exampleAddress2" placeholder="Masukkan Kode" type="text" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label class="">Nama</label><input name="nama" placeholder="Masukkan Nama" type="nama" class="form-control"></div>
                            </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="examplePassword11" class="">Tipe</label>
                                <select type="select" id="exampleCustomSelect" name="tipe" class="custom-select">
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="form-row">
                        <div class="col-md">
                            <div class="position-relative form-group"><label for="exampleCity" class="">Bobot</label>
                                <input class="form-control" type="number" name="bobot" min="0" max="1" step="0.01">   
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

    @foreach ($kriterias as $kriteria)
    <form action="{{ route('kriteria.update',$kriteria->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="modal fade bd-example-modal-lg" id="editModal-{{$kriteria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="position-relative form-group"><label for="examplePassword11" class="">Tipe</label>
                                <select type="select" name="tipe-{{$kriteria->id}}" class="custom-select">
                                    <option value="benefit" @if ($kriteria->tipe == "benefit") selected @endif>Benefit</option>
                                    <option value="cost" @if ($kriteria->tipe == "cost") selected @endif>Cost</option>
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="form-row">
                        <div class="col-md">
                            <div class="position-relative form-group"><label for="exampleCity" class="">Bobot</label>
                                <input class="form-control" type="number" name="bobot-{{$kriteria->id}}" min="0" max="1" step="0.01" value="{{$kriteria->bobot}}">   
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