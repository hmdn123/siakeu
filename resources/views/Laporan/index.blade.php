@extends('Template.app')

@section('content')

<div class="pagetitle">
  <h1>Laporan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Laporan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Filter Data</h5>
          <div class="row">
            <div class="col-md-6">
              <label for="keterangan" class="form-label">Jenis Transaksi</label>
              <select name="keterangan" class="form-select @error('keterangan') is-invalid @enderror" >
                <option selected disabled value="">Choose...</option>
                @foreach ( $jenis as $jenis )
                <option value="{{ $jenis->keterangan }}" >{{ $jenis->keterangan }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="jenis" class="form-label">Kategori Transaksi</label>
              <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                <option selected disabled value="">Choose...</option>
                <option value="Debit">Debit | Pemasukan</option>
                <option value="Kredit">Kredit | Pengeluaran</option>
              </select>
            </div>
          </div>
          <hr>
          <h5 class="card-title">Download :
            <div class=" float-end">
              Pdf :
              <a href="{{ url('/laporan/view/pdf' )}}" target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-eye-fill"></i></a>
              <a href="{{ url('/laporan/download/pdf' )}}" class="btn btn-warning btn-sm"><i class="bi bi-download"></i></a>
              | Excel :
              <a href="{{ url('/laporan/download/excel' )}}" class="btn btn-primary btn-sm"><i class="bi bi-download"></i></a>
            </div>
          </h5>
          <br>
          @include('Laporan.table',$transaksi)
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

@section('js')

@endsection