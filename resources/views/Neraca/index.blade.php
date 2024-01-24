@extends('Template.app')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Neraca</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Neraca Saldo </h5>

                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">KODE AKUN</th>
                                    <th scope="col">NAMA AKUN</th>
                                    <th scope="col">DEBIT</th>
                                    <th scope="col">KREDIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis as $data)
                                    <tr>
                                        <td>{{ $data->kode }}</td>
                                        <td>{{ $data->keterangan }}</td>

                                        @php
                                            $Debit = App\Models\Transaksi::where('kode', $data->kode)
                                                ->where('jenis', 'Debit')
                                                ->sum('nominal');
                                            $Kredit = App\Models\Transaksi::where('kode', $data->kode)
                                                ->where('jenis', 'Kredit')
                                                ->sum('nominal');
                                            $Saldo = $Debit - $Kredit;
                                        @endphp
                                        <td>@currency($Debit)</td>
                                        <td>@currency($Kredit)</td>
                                    </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="fw-bold text-center">Saldo Akhir @currency(App\Models\Transaksi::where('jenis', 'Debit')->sum('nominal') - App\Models\Transaksi::where('jenis', 'Kredit')->sum('nominal'))</td>
                                </tr>
                            </tfoot>
                            <tfoot>
                                <tr>
                                    <th style="text-align: right;" colspan="2"></th>
                                    <th>@currency(App\Models\Transaksi::where('jenis', 'Debit')->sum('nominal'))</th>
                                    <th>@currency(App\Models\Transaksi::where('jenis', 'Kredit')->sum('nominal'))</th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        table,
        td,
        thead,
        tfoot {
            border: 1px solid;
        }

        thead,
        tfoot {
            background-color: green;
            color: white;
        }
    </style>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        title: 'NERACA SALDO',
                        messageTop: 'diDownload oleh : {{ Auth::user()->name }}',
                        footer: true
                    },
                    {
                        extend: 'pdf',
                        title: 'NERACA SALDO',
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
