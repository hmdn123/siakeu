@extends('Template.app')

@section('content')

<div class="pagetitle">
  <h1>Transaksi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Setting</li>
      <li class="breadcrumb-item active">Jenis Transaksi</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Jenis Transaksi</h5>
          <form class="row g-3" action="{{ route('jenis.store') }}" method="POST">
            @csrf
            <div class="col-md-4">
              <label for="kode" class="form-label">Kode Transaksi</label>
              <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode') }}" id="keterangan">
              <!-- error message untuk kode -->
              @error('kode')
              <div class="alert alert-danger mt-2">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan') }}" id="keterangan">
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
          <h5 class="card-title">Data Jenis Transaksi</h5>
          <!-- Small tables -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">KODE</th>
                <th scope="col">KETERANGAN</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($jenis as $jenis)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{ $jenis->kode }}</td>
                <td>{{ $jenis->keterangan }}</td>
              </tr>
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
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>
@endsection