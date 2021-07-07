<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Detail Calon Siswa {{$siswa->nama_siswa}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body>
  <style>
    #header,
    #footer {
      position: fixed;
      left: 0;
        right: 0;
        color: #aaa;
        font-size: 0.9em;
    }
    #header {
      top: 0;
        border-bottom: 0.1pt solid #aaa;
    }
    #footer {
      bottom: 0;
      border-top: 0.1pt solid #aaa;
    }
    .page-number:before {
        text-align: center;
        float: right;
        color: black;
      content: "SD NEGERI 004 Sangatta Utara | Hal " counter(page);
    }

    .page-break {
        page-break-after: always;
    }

    h1 {
        font-size: 40px;
    }

    h2 {
        font-size: 30px;
    }

    p {
        font-size: 12px;
        line-height:80%;
    }

    td{
      font-size: 14px;
      text-align: center;
      vertical-align: middle;
    }

    th{
      text-align: center;
    }
    .table > tbody > tr > td {
     vertical-align: middle;
    }
    </style>
<div>
  <div id="footer">
    <div class="page-number"></div>
  </div>
  <img src="{{$base64}}" width="100%" height="140"/>
  <table class="table table-sm table-borderless" style="border: white;">
    <thead class="mb-0">
      <tr>
        <th style="text-align: center; vertical-align: middle; font-size: 25px;" class="text-underline"><u>Laporan Detail Informasi Siswa</u></th>
    </tr>
    {{-- <tr>
      <th style="text-align: center; vertical-align: middle;">Detail Informasi Pengajar</th>
    </tr> --}}
    </thead>
  </table>
    <table class="table table-sm table-bordered">
        <thead style="font-size:10px;" class="thead-light">
          <tr>
            <th colspan="3" style="text-align: center; vertical-align: middle; font-size: 15px;"><span>Biodata Calon Siswa</span></th>
          </tr>
          <tr>
            <td style="text-align: left; vertical-align: middle;">
              <span>No. NIK</span> <br>
              <span>Nama</span> <br>
              <span>Jenis Kelamin</span> <br>
              <span>Alamat</span> <br>
              <span>Tanggal Lahir</span> <br>
              <span>Umur</span> <br>
              <span>Jarak Sekolah</span><br>
              <span>Penghasilan Orang Tua</span> <br>
              <span>Potensi Akademik</span> <br>
            </td>
            <td style="text-align: left; vertical-align: middle;">
              <span>{{$siswa->nik}}</span> <br>
              <span>{{$siswa->nama_siswa}}</span> <br>
              <span>@if ($siswa->jenis_kelamin == 0) Laki - Laki @else Perempuan @endif</span> <br>
              <span>{{$siswa->alamat}}</span> <br>
              <span>{{$siswa->tanggal_lahir->format('d/m/Y')}}</span> <br>
              <span>{{$siswa->umur}} Tahun</span> <br>
              <span>{{$siswa->jarak_sekolah}} Km</span> <br>
              <span>RP. {{$siswa->penghasilan_orang_tua}}</span> <br>
              <span>{{$siswa->potensi_akademik}}</span> <br>
            </td>
            <td>
              <img src="{{ url('public/siswa/foto/'.$siswa->foto_anak) }}" class="mt-3 mb-0 px-0 py-0" alt="..." style="width: 100px; height: 120px;">
            </td>
          </tr>
        </thead>
    </table>


        <table class="table table-borderless">
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td style="width: 200px;">Kepala Sekolah SD Negeri 004 Sangatta Utara, ... - ...... - .....</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td style="height: 20px; width: 150px;"></td>
            </tr>
            <tr>
              <td></td>
              <td ></td>
              <td style="width: 150px;"><u>............................</u></td>
            </tr>
          </tbody>
        </table>

</div>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>