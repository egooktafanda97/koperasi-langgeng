<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            position: relative;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px;
            top: 0;
            position: absolute;
            /* Adjust the width as needed */
            /* height: auto; */
            margin-right: 20px;
        }

        .kop-teks {
            text-align: center;
            flex: 1;
        }

        .kop-teks h1,
        .kop-teks h2 {
            margin: 0;
        }

        hr {
            border: 1px solid black;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            font-size: .8em;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot {
            background-color: #f2f2f2;
        }

        .image-grid {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly !important;
            justify-items: center;
            /* Untuk mengompensasi margin pada gambar */
        }

        .image-grid img {
            margin-top: 10px;
            height: 150px;
            padding-top: 10px;
            width: 19%;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="kop-teks">
            <h3 style="margin: 0px;">..</h3>
            <h4 style="margin: 0px;">..</h4>

        </div>
    </div>
    <hr>

    <h4>Laporan</h4>
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>No</th>
                <th>No</th>
                <th>Bulan</th>
                <th>Pendapatan</th>
                <th>Pengeluaran</th>
                <th>Keterangan</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->pendapatan }}</td>
                    <td>{{ $item->pengeluaran }}</td>
                    <td>{{ $item->keterangan }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 100px">
        {{-- ttd --}}
        <div style="text-align: right; margin-right: 10px">
            <p>Kuantan Singingi, {{ date('d F Y') }}</p>
            <p>Kepala ...</p>
            <br><br><br>
            <p><strong>...</strong></p>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
