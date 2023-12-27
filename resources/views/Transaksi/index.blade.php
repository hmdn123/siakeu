@extends('Template.app')

@section('content')

<div class="pagetitle">
  <h1>Transaksi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Transaksi</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Transaksi</h5>
          <p>Input setiap pemasukan dan pengeluaran yang dilakukan.</p>
          <form class="row g-3" action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="col-md-3">
              <label for="transaksi" class="form-label">Jenis Transaksi</label>
              <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                <option selected disabled value="">Choose...</option>
                <option value="Pemasukan">Pemasukan</option>
                <option value="Pengeluaran">Pengeluaran</option>
              </select>
              <!-- error message untuk jenis -->
              @error('jenis')
              <div class="alert alert-danger mt-2">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-md-5">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan') }}" id="keterangan">
              <!-- error message untuk keterangan -->
              @error('keterangan')
              <div class="alert alert-danger mt-2">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-md-4">
              <label for="nominal" class="form-label">Nominal</label>
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">Rp</span>
                <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal') }}" id="nominal">
                <!-- error message untuk nominal -->
                @error('nominal')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form><!-- End Multi Columns Form -->
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">SALDO</h5>
          <h1>@currency($saldo_akhir)</h1>
          <hr>
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Total Pemasukan</th>
                <td>: @currency($total_pemasukan)</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Total Pengeluaran</th>
                <td>: @currency($total_pengeluaran)</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">History Transaksi</h5>
          <!-- Small tables -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tgl</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Debit</th>
                <th scope="col">Kredit</th>
                <th scope="col">Account</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transaksi as $transaksi)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{ $transaksi->created_at }}</td>
                <td>{{ $transaksi->keterangan }}</td>
                @if ($transaksi->jenis === "Pemasukan")
                <td>@currency($transaksi->nominal)</td>
                <td></td>
                @else
                <td></td>
                <td>@currency($transaksi->nominal)</td>
                @endif
                <td>{{ $transaksi->user->name }}</td>
                <td>
                  <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                    <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#EditTransaksi_{{ $transaksi->id }}"><i class="bi bi-pencil-square"></i></a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
              <!-- modal edit -->
              <div class="modal fade" id="EditTransaksi_{{ $transaksi->id }}" tabindex="-1">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Data Transaksi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label for="jenis" class="form-label">Jenis Transaksi</label>
                          <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                            <option selected disabled value="">Choose...</option>
                            <option value="Pemasukan" @if($transaksi->jenis == "Pemasukan") selected @endif>Pemasukan</option>
                            <option value="Pengeluaran" @if($transaksi->jenis == "Pengeluaran") selected @endif>Pengeluaran</option>
                          </select>
                          <!-- error message untuk jenis -->
                          @error('jenis')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="keterangan" class="form-label">Keterangan</label>
                          <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ $transaksi->keterangan }}" id="keterangan">
                          <!-- error message untuk keterangan -->
                          @error('keterangan')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="nominal" class="form-label">Nominal</label>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ $transaksi->nominal }}" id="nominal">
                            <!-- error message untuk nominal -->
                            @error('nominal')
                            <div class="alert alert-danger mt-2">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- End Small Modal-->
              @empty
              <div class="alert alert-danger">
                Data Transaksi belum Tersedia.
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
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>
@endsection