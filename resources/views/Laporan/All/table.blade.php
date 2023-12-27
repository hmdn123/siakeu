<h3 style="text-align: center;"><b> LAPORAN KEUANGAN </b></h3>
<table class="table">
    <thead class="table-success">
        <tr style="text-align: center;">
            <th scope="col">No.</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Uraian Transaksi</th>
            <th scope="col">Account</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
        </tr>
    </thead>
    <tbody>
        @php
        $kosong = "0"
        @endphp
        @forelse ($transaksi as $transaksi)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $transaksi->created_at->isoFormat('DD MMMM Y') }}</td>
            <td>{{ $transaksi->keterangan }}</td>
            <td>{{ $transaksi->user->name }}</td>
            @if ($transaksi->jenis === "Pemasukan")
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
            <th style="text-align: right;" colspan="4"><b> TOTAL : </b></th>
            <th><b> @currency($total_pemasukan) </b></th>
            <th><b> @currency($total_pengeluaran) </b></th>
        </tr>
        <tr>
            <th style="text-align: right;" colspan="4"><b> SALDO : </b></th>
            <th colspan="2"><b> @currency($saldo_akhir) </b></th>
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