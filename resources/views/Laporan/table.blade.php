@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

<div>
    <h3 style="text-align: center;" class="mt-4"><b> LAPORAN KEUANGAN </b></h3>
    <hr>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>KODE AKUN</th>
                <th>NAMA AKUN</th>
                <th>URAIAN</th>
                <th>USER</th>
                <th>DEBIT</th>
                <th>KREDIT</th>
            </tr>
        </thead>
        <tbody>
            @php
            $kosong = "0"
            @endphp
            @forelse ($data as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{ $data->created_at->isoFormat('DD MMMM Y') }}
                    <br>
                    {{ $data->created_at->isoFormat('HH:MM A') }}
                </td>
                <td>{{ $data->kode }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>{{ $data->detail }}</td>
                <td>{{ $data->user->name }}</td>
                @if ($data->jenis === "Debit")
                <td>@currency($data->nominal)</td>
                <td>@currency($kosong)</td>
                @else
                <td>@currency($kosong)</td>
                <td>@currency($data->nominal)</td>
                @endif
            </tr>
            @empty
            <div class="alert alert-danger">
                Data Laporan Transaksi belum Tersedia.
            </div>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align: right;" colspan="6"></th>
                <th> @currency($total_pemasukan)</th>
                <th> @currency($total_pengeluaran)</th>
            </tr>
        </tfoot>
    </table>
</div>

<style>
    table, td, thead, tfoot 
    {
        border: 1px solid;
    }

    thead, tfoot
    {
        background-color: green;
        color: white;
    }
</style>

@section('js')
<script>
    $(document).ready(function() {
        $('#example').append(
            '<caption style="text-align: center; caption-side: bottom; background-color: green; color: white;"><b>Saldo Akhir : @currency($saldo_akhir)</b></caption>'
        );

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    title: 'LAPORAN KEUANGAN',
                    messageTop: 'diDownload oleh : {{ Auth::user()->name }}',
                    footer: true
                },
                {
                    extend: 'pdf',
                    title: 'LAPORAN KEUANGAN',
                    messageTop: 'diDownload oleh : {{ Auth::user()->name }}',
                    footer: true
                }
            ]
        });
    });
</script>
<script src="//code.jquery.com/jquery-3.7.0.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
@endsection