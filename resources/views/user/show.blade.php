@extends('layouts.app', 
    [
        'title' => 'Detail Pengguna',
        'keterangan' => 'Detail Informasi Pengguna ',
        'icon' => 'pe-7s-user'
    ])

@section('tombol')
    <a href="{{route('user')}}" type="button" data-toggle="tooltip" title="Cetak Laporan" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
        <i class="fa fa-arrow-left"> Kembali</i>
    </a>
    <button type="button" title="Tambah Data" data-placement="bottom" data-toggle="modal" data-target="#modalTambah" class="btn-shadow mr-3 btn btn-primary">
        <i class="fa fa-key"> Ganti Password </i>
    </button>
@endsection

@section('content') 
<form action="{{ route('user.update',$user->id) }}"  method="POST" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-12">
                       <div class="position-relative form-group">
                            <label for="exampleAddress2" class="">Username</label>
                            <input name="nama" id="exampleAddress2" placeholder="Masukkan Username" type="text" class="form-control" value="{{$user->nama}}">
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="exampleEmail11" class="">Email</label><input name="email" id="exampleEmail11" placeholder="Masukkan Email" type="email" class="form-control" value="{{$user->email}}"></div>
                        </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="examplePassword11" class="">Peran</label>
                            <select type="select" id="exampleCustomSelect" name="peran" class="custom-select">
                                <option value="0" @if ($user->role == 0) selected @endif>Pimpinan</option>
                                <option value="1" @if ($user->role == 1) selected @endif>Staf</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{-- <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Tutup</button> --}}
                <input type="hidden" name="updateData" value="1">
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection   

@section('modal')
<form action="{{ route('user.update',$user->id) }}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> <i class="fas fa-key"></i> Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="position-relative form-group"><label for="exampleCity" class="">Password Terdahulu</label>
                                <input class="form-control" type="password" class="form-control" id="myInput" name="password">
                                <div class="form-check mb-2 mr-sm-2">
                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck" onclick="myFunction()">
                                    <label class="form-check-label" for="inlineFormCheck"> 
                                      Lihat password
                                    </label>
                                  </div>    
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="position-relative form-group"><label for="exampleState" class="">Password Baru</label><input name="password_baru" id="exampleState" type="password" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <input type="hidden" name="updateData" value="2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
                        
@push('js')
    <script>
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