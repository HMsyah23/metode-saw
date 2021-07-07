@extends('layouts.app', 
    [
        'title' => 'Data Pengguna',
        'keterangan' => 'Data Pengguna yang dapat mengakses sistem',
        'icon' => 'pe-7s-user'
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
            <div class="card-body"><h5 class="card-title">Daftar Pengguna</h5>
                <div class="table-responsive">
                    <table id="myTable" class="mb-0 table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username </th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->nama}}</td>
                                <td>{{$user->email}}</td>
                                @if ($user->role == 0)
                                    <td>Pimpinan</td>
                                @else
                                    <td>Staf</td>
                                @endif
                                <td>
                                    {{-- <button class="btn btn-sm btn-primary rounded-rounded" data-toggle="modal" data-target="#exampleModal-{{$user->id}}" data-backdrop="static"> <i class="fas fa-eye"></i></button> --}}
                                        <a href="{{route('user.show',$user->id ?? '')}}" class="btn btn-sm btn-warning rounded-rounded" data-toggle="tooltip" title="Edit Data" data-placement="bottom"> <i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger rounded-rounded" data-toggle="modal" data-target="#deleteModal-{{$user->id}}" data-backdrop="static"> <i class="fas fa-trash"></i></button>
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
<form action="{{ route('user.save') }}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> <i class="fas fa-user"></i> Tambah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                           <div class="position-relative form-group">
                                <label for="exampleAddress2" class="">Username</label>
                                <input name="nama" id="exampleAddress2" placeholder="Masukkan Username" type="text" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleEmail11" class="">Email</label><input name="email" id="exampleEmail11" placeholder="Masukkan Email" type="email" class="form-control"></div>
                            </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="examplePassword11" class="">Peran</label>
                                <select type="select" id="exampleCustomSelect" name="peran" class="custom-select">
                                    <option value="0">Pimpinan</option>
                                    <option value="1">Staf</option>
                                </select>
                            </div>
                        </div>
                    </div>    
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleCity" class="">Password</label>
                                <input class="form-control" type="password" class="form-control" id="myInput" name="password">
                                <div class="form-check mb-2 mr-sm-2">
                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck" onclick="myFunction()">
                                    <label class="form-check-label" for="inlineFormCheck"> 
                                      Lihat password
                                    </label>
                                  </div>    
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleState" class="">Ulangi Password</label><input name="password_confirmation" id="exampleState" type="password" class="form-control"></div>
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

    @foreach ($users as $user)
    <div class="modal fade bd-example-modal-lg" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h6 class="modal-title text-white" id="exampleModalLabel"> <i class="fa fa-trash"></i> Yakin menghapus Data ?</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
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