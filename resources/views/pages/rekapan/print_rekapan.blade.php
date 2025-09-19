<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

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
            margin-top: 5px;
        }

        table,
        td {
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

    <div>
        <h3 style="text-align:center; margin-bottom:0;">
            Rekapan Surat
            @if($type == 'incoming')
            Masuk
            @elseif($type == 'outgoing')
            Keluar
            @endif
        </h3>
        <p style="text-align:center; margin-top:4px;">
            Periode
            @if($periode == 'today')
            {{ \Carbon\Carbon::now()->translatedFormat('d/m/Y') }}
            @elseif($periode == 'thisMonth')
            {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
            @elseif($periode == 'thisYear')
            {{ \Carbon\Carbon::now()->year }}
            @else
            {{ \Carbon\Carbon::now()->translatedFormat('d/m/Y') }}
            @endif
        </p>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <p><strong>Total Surat :</strong> {{$letterTransaction}}</p>
        @if($type == 'incoming')
        <p><strong>Surat Masuk:</strong> {{$incomingLetter}}</p>
        @elseif($type == 'outgoing')
        <p><strong>Surat Keluar:</strong> {{$outgoingLetter}}</p>
        @else
        <p><strong>Surat Masuk:</strong> {{$incomingLetter}}</p>
        <p><strong>Surat Keluar:</strong> {{$outgoingLetter}}</p>
        @endif
        <p><strong>Total Disposisi:</strong> {{$dispositionLetter}}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nomor Surat</th>
                <th>Jenis Surat</th>
                @if($type == 'incoming')
                <th>Pengirim</th>
                @elseif($type == 'outgoing')
                <th>Penerima</th>
                @else
                <th>Pengirim</th>
                <th>Penerima</th>
                @endif
                <th>Tanggal</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $letter)
            <tr>
                <td>{{ $letter->reference_number }}</td>
                <td>{{ $letter->type == "incoming" ? "Surat Masuk" : "Surat Keluar" }}</td>
                @if($type == 'incoming')
                <td>{{ $letter->from }}</td>
                @elseif($type == 'outgoing')
                <td>{{ $letter->to }}</td>
                @else
                <td>{{ $letter->from }}</td>
                <td>{{ $letter->to }}</td>
                @endif
                <td>{{ $letter->formatted_letter_date }}</td>
                <td>{{ $letter->note }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>