<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keluar</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    .header {
      text-align: center;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
      position: relative;
    }
    .logo {
      position: absolute;
      left: 20px;
      top: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, td {
      border: 1px solid black;
    }
    td {
      padding: 8px;
      vertical-align: top;
    }
    .footer {
      margin-top: 50px;
      text-align: right;
    }
  </style>
</head>
<body onload="window.print()">
  <div class="header">
    <img src="/logo.png" alt="Logo SMK" class="logo" width="80">
    <h3>DINAS PENDIDIKAN KABUPATEN PURBALINGGA</h3>
    <h2>SMK MA'ARIF NU BOBOTSARI</h2>
    <p>Alamat: Jl. Kp. Baru, Gandasuli, Kec. Bobotsari, Kabupaten Purbalingga, Jawa Tengah 53353 Telp. (021) XXXXXXXX</p>
  </div>

  <h3 style="text-align:center;">SURAT</h3>

  <table>
    <tr>
      <td width="30%">Nomor Surat</td>
      <td>{{$letter->reference_number}}</td>
    </tr>
    <tr>
      <td>Lampiran</td>
      <td>-</td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td>...................................................</td>
    </tr>
    <tr>
      <td>Tanggal</td>
      <td>{{$letter->created_at}}</td>
    </tr>
    <tr>
      <td>Kepada Yth</td>
      <td>
        {{$letter->to}}
      </td>
    </tr>
    <tr>
      <td>Isi Surat</td>
      <td style="height:150px;">
        {!! $letter->content !!}
      </td>
    </tr>
  </table>

    <div class="footer">
        <p>Kepala Sekolah,</p>

        @if($letter->signed)
            <img src="/logo.png" alt="Tanda Tangan" class="ttd" width="80" style="margin-right: 15px;">
        @else
            <br><br><br>
        @endif

        <p><b>Kepala Sekolah</b><br>
        NIP. 12345567</p>
    </div>
</body>
</html>
