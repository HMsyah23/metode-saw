<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Peringkat Calon Siswa</title>
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
      font-size: 10px;
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
        <th style="text-align: center; vertical-align: middle; font-size: 25px;" class="text-underline"><u>Laporan Peringkat Siswa</u></th>
    </tr>
    </thead>
  </table>
    <table class="table table-sm table-bordered">
        <thead style="font-size:10px;" class="thead-light">
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Informasi</th>
            <th>Potensi Anak</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $calon)
            <tr>
              <td style="font-size: 20px;">{{$loop->iteration}}</td>
              <td>
                {{-- <div class="img-container">
                  <img src="{{ url('storage/pengajar/foto/'.$calon['foto']) }}" class="mt-2 mb-1" alt="..." style="width: 40px; height: 50px;">
                </div> --}}
                <span>Nama          : {{$calon['nama']}}</span> <br>
                <span>Umur          :  {{$calon['umur']}} Tahun</span> <br>
                <span>Jenis Kelamin : @if ($calon['jk'] == 1)
                  Laki - Laki
                @else
                    Perempuan
                @endif
              </span>
              </td>
              <td>
                <span>Alamat : {{$calon['alamat']}}</span> <br>
                <span>Jarak Rumah            :  {{$calon['jarak']}} KM</span> <br>
                <span>Penghasilan Orang Tua  : Rp. {{$calon['penghasilan']}}</span>
              </td>
              <td style="font-size:12px;">
                  {{$calon['potensi']}}
              </td>
            @endforeach
        </tbody>
    </table>

    <div style="float: right; width: 28%;margin-top: 50px;">
      <table>
        <tr>
          <td>Kepala Sekolah SD Negeri 004 Sangatta Utara, ... - ...... - .....</td>
        </tr>
        <tr>
          <td style="height: 50px;"></td>
        </tr>
        <tr>
          <td><u>.......................</u></td>
        </tr>
      </table>
    </div>
    <div id="footer">
      <div class="page-number"></div>
    </div>

    
</div>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>