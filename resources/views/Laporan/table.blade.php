<h3 style="text-align: center;"><b> LAPORAN KEUANGAN </b></h3>
<table class="table">
    <thead class="table-success">
        <tr style="text-align: center;">
            <th scope="col">No.</th>
            <th scope="col">TANGGAL</th>
            <th scope="col">KODE</th>
            <th scope="col">JENIS</th>
            <th scope="col">URAIAN</th>
            <th scope="col">ACCOUNT</th>
            <th scope="col">DEBIT</th>
            <th scope="col">KREDIT</th>
        </tr>
    </thead>
    <tbody>
        @php
        $kosong = "0"
        @endphp
        @forelse ($transaksi as $transaksi)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>
                {{ $transaksi->created_at->isoFormat('DD MMMM Y') }}
                <br>
                {{ $transaksi->created_at->isoFormat('HH:MM A') }}
            </td>
            <td>{{ $transaksi->kode }}</td>
            <td>{{ $transaksi->keterangan }}</td>
            <td>{{ $transaksi->detail }}</td>
            <td>{{ $transaksi->user->name }}</td>
            @if ($transaksi->jenis === "Debit")
            <td>@currency($transaksi->nominal)</td>
            <td>@currency($kosong)</td>
            @else
            <td>@currency($kosong)</td>
            <td>@currency($transaksi->nominal)</td>
            @endif
        </tr>
        @empty
        <div class="alert alert-danger">
            Data Laporan Transaksi belum Tersedia.
        </div>
        @endforelse
    </tbody>
    <tfoot class="table-success">
        <tr>
            <th style="text-align: right;" colspan="6"><b> TOTAL : </b></th>
            <th><b> @currency($total_pemasukan) </b></th>
            <th><b> @currency($total_pengeluaran) </b></th>
        </tr>
        <tr>
            <th style="text-align: right;" colspan="6"><b> SALDO : </b></th>
            <th colspan="4"><b> @currency($saldo_akhir) </b></th>
        </tr>
    </tfoot>
</table>

<style>
    table,td,th
    {
        border: 1px solid;
        padding: 8px;
    }

    table
    {
        width: 100%;
        border-collapse: collapse;
    }

    th
    {
        background-color: #04AA6D;
        color: white;
    }
</style>