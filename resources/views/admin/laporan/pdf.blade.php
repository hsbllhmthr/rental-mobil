<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cetak Detail Laporan</title>
    <style>
        body {
            color: #000000;
            font-family: "Times New Roman", serif;
            font-size: 13px;
        }
        h2, h3, h4, h5 { margin: 0; padding: 0; }
        h2 { font-size: 22px }
        h3 { font-size: 20px }
        h4 { font-size: 17px }
        h5 { font-size: 15px }
        .text-center { text-align: center; }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-borderless>tbody>tr>td {
            border: none;
            padding: 0 0 2pt;
        }
        .table>thead>tr>th {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #000000;
            font-weight: bold;
            padding: 8px;
        }
        .table>tbody>tr>td {
            border: 1px solid #000000;
            padding: 8px;
        }
        .table>tfoot>tr>th {
            border: 1px solid #000000;
            padding: 8px;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center; /* Tambahkan ini */
        }
        .report-details h5 {
            font-size: 12px; /* Samakan dengan font alamat */
            font-weight: normal; /* Menghilangkan efek bold */
            margin-top: 5px;
        }
    </style>
</head>
<body>
    
    <section id="header-kop">
        <table class="table table-borderless" style="margin-bottom: 5px;">
            <tbody>
                <tr style="border: none;">
                    <td rowspan="3" width="16%" class="text-center" style="border: none; vertical-align: top; padding-top: 5px;">
                        {{-- Anda bisa ganti dengan <img> jika punya logo --}}
                    </td>
                    <td class="text-center" style="border: none; padding: 0;"><h3 style="line-height: 1.0;">Rental Mobil</h3></td>
                    <td rowspan="3" width="16%" style="border: none;">&nbsp;</td>
                </tr>
                <tr style="border: none;">
                    <td class="text-center" style="border: none; padding: 0;"><h2 style="line-height: 1.0;">Tri Manunggal</h2></td>
                </tr>
                <tr style="border: none;">
                    <td class="text-center" style="border: none; padding: 0; font-size: 12px; line-height: 1.0;">Jl. Raya Buniayu, Ds.Sukahurip, Kec.Sukatani. Bekasi</td>
                </tr>
            </tbody>
        </table>
        <hr style="border: none; border-top: 2px solid #000000; margin-bottom: 2px;"/>
        <hr style="border: none; border-top: 1px solid #000000; margin-top: 0;"/>
    </section>

    <section id="body-of-report">
        <h4 class="text-center" style="margin-top: 20px;">Detail Laporan</h4>
        <h5 style="font-size: 12px; font-weight: normal; margin-top: 5px; text-align: center;">
            Periode: 
            @if($tanggal_awal && $tanggal_akhir)
                {{ \Carbon\Carbon::parse($tanggal_awal)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($tanggal_akhir)->translatedFormat('d F Y') }}
            @else
                Semua Periode
            @endif
        </h5>
        <br/>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sewa</th>
                    <th>Tanggal Sewa</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @php $total_pendapatan = 0; @endphp
                @forelse ($rentals as $rental)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>TRX{{ str_pad($rental->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $rental->tanggal_mulai->format('d-m-Y') }}</td>
                    <td style="text-align: center;">Rp {{ number_format($rental->total_biaya, 0, ',', '.') }}</td>
                </tr>
                @php $total_pendapatan += $rental->total_biaya; @endphp
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data transaksi pada periode yang dipilih.</td>
                </tr>
                @endforelse
            </tbody>
            @if(count($rentals) > 0)
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: center;">Total Pemasukan</th>
                    <th style="text-align: center;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
            @endif
        </table>
    </section>

</body>
</html>