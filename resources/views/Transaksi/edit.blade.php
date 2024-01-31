@extends('Template.app')

@section('content')
    <div class="pagetitle">
        <h1>Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Transaksi | Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Data Transaksi</h5>
                        <form action="{{ url('/transaksi/update', $transaksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="keterangan">Jenis Transaksi</label>
                                <div class="col-sm-4">
                                    <select name="keterangan" class="form-select" @error('keterangan') is-invalid @enderror"
                                        id="jenis">
                                        <option selected disabled value="">Choose...</option>
                                        @foreach ($jenis as $jenis)
                                            <option value="{{ $jenis->keterangan }}" data-kode="{{ $jenis->kode }}"
                                                {{ $jenis->keterangan == $transaksi->keterangan ? 'selected' : '' }}>
                                                {{ $jenis->keterangan }}</option>
                                        @endforeach
                                    </select>
                                    <!-- error message untuk jenis -->
                                    @error('keterangan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <label for="kode" class="col-sm-2 col-form-label">Kode Transaksi</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                        value="{{ old('kode', $transaksi->kode) }}" id="kode" name="kode">
                                    <!-- error message untuk keterangan -->
                                    @error('kode')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="jenis">Kategori Transaksi</label>
                                <div class="col-sm-4">
                                    <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="Debit" @if ($transaksi->jenis == 'Debit') selected @endif>Debit |
                                            Pemasukan</option>
                                        <option value="Kredit" @if ($transaksi->jenis == 'Kredit') selected @endif>Kredit |
                                            Pengeluaran</option>
                                    </select>
                                    <!-- error message untuk jenis -->
                                    @error('jenis')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="detail">Uraian</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('detail') is-invalid @enderror"
                                        name="detail" value="{{ $transaksi->detail }}" id="detail">
                                    <!-- error message untuk detail -->
                                    @error('detail')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="nominal">Tanggal Input</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="date" class="form-control @error('tgl_input') is-invalid @enderror"
                                            name="tgl_input" value="{{ $transaksi->tgl_input }}" id="tgl_input">
                                        <!-- error message untuk nominal -->
                                        @error('tgl_input')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="nominal">Nominal</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                            name="nominal" value="{{ $transaksi->nominal }}" id="nominal">
                                        <!-- error message untuk nominal -->
                                        @error('nominal')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a type="button" class="btn btn-secondary" href="{{ url('transaksi') }}">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#jenis').on('change', function() {
                const selected = $(this).find('option:selected');
                const kode = selected.data('kode');

                $("#kode").val(kode);
            });
        });
    </script>
    <script>
        //message with toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success ') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error ') }}', 'GAGAL!');
        @endif
    </script>
@endsection
