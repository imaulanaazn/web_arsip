<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Disposisi</title>
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
    table, th, td {
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
    <img src="/logo-mabos.png" alt="Logo SMK" class="logo" width="80">
    <h3>DINAS PENDIDIKAN KABUPATEN PURBALINGGA</h3>
    <h2>SMK MA'ARIF NU BOBOTSARI</h2>
    <p>Alamat: Jl. Kp. Baru, Gandasuli, Kec. Bobotsari, Kabupaten Purbalingga, Jawa Tengah 53353 Telp. (021) XXXXXXXX</p>
  </div>

  <h3 style="text-align:center;">SURAT DISPOSISI</h3>

  <table>
    <tr>
      <td width="30%">Nomor Agenda</td>
      <td>{{$letter->agenda_number}}</td>
    </tr>
    <tr>
      <td width="30%">Nomor Surat</td>
      <td>{{$letter->reference_number}}</td>
    </tr>
    <tr>
      <td>Tanggal Surat</td>
      <td>{{$letter->letter_date}}</td>
    </tr>
    <tr>
      <td>Dari</td>
      <td>{{$letter->from}}</td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td>...................................................</td>
    </tr>
    <tr>
      <td>Tanggal Terima</td>
      <td>{{$letter->received_date}}</td>
    </tr>
    <tr>
      <td>Diteruskan Kepada</td>
      <td>{{$disposition->to}}</td>
      <!-- <td>
        ☐ Wakasek Kurikulum <br>
        ☐ Wakasek Kesiswaan <br>
        ☐ Wakasek Sarpras <br>
        ☐ Tata Usaha <br>
        ☐ Guru/Staf Terkait <br>
        ☐ Arsip
      </td> -->
    </tr>
    <tr>
      <td>Instruksi / Disposisi</td>
      <td style="height:80px;">{{$disposition->content}}</td>
    </tr>
    <tr>
      <td>Catatan</td>
      <td style="height:60px;">{{$disposition->note}}</td>
    </tr>
  </table>

  <div class="footer">
    <p>Kepala Sekolah,</p>
    <br><br><br>
    <p><b>(Nama Kepala Sekolah)</b><br>
    NIP. ....................................</p>
  </div>
</body>
</html>
