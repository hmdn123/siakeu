@extends('Template.app')

@section('content')
    <div class="pagetitle">
        <h1>Nama Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Setting</li>
                <li class="breadcrumb-item active">Nama Akun</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nama Akun</h5>
                        <form class="row g-3" action="{{ route('jenis.store') }}" method="POST">
                            @csrf
                            <div class="col-md-4">
                                <label for="kode" class="form-label">Kode Akun</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    name="kode" value="{{ old('kode') }}" id="keterangan">
                                <!-- error message untuk kode -->
                                @error('kode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Nama Akun</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    name="keterangan" value="{{ old('keterangan') }}" id="keterangan">
                                <!-- error message untuk keterangan -->
                                @error('keterangan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-2 text-center">
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Nama Akun</h5>
                        <!-- Small tables -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Akun</th>
                                    <th scope="col">Nama Akun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jenis as $jenis)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $jenis->kode }}</td>
                                        <td>{{ $jenis->keterangan }}
                                            @if (app('request')->input('edit'))
                                                <a class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#EditAccount_{{ $jenis->id }}"><i
                                                        class="bi bi-pencil-square"></i> Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- modal edit -->
                                    <div class="modal fade" id="EditAccount_{{ $jenis->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Nama Akun</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama akun</label>
                                                            <input type="text"
                                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                                name="keterangan" value="{{ $jenis->keterangan }}"
                                                                id="keterangan">
                                                            <!-- error message untuk nama -->
                                                            @error('keterangan')
                                                                <div class="alert alert-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Small Modal-->
                                @empty
                                    <div class="alert alert-danger">
                                        Data Jenis Transaksi belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End small tables -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endsection
