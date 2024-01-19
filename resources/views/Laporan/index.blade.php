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
          <h5 class="card-title">Filter Data Transaksi</h5>
          <form action="laporan" method="get">
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="kode" class="form-label">Jenis</label>
                <select id="kode" name="kode" class="form-select">
                  <option selected disabled value="">Choose...</option>
                  @foreach ( $jenis as $jenis )
                  <option value="{{ $jenis->kode }}" {{ Request::get('kode') == $jenis->kode ? 'selected':''}}>{{ $jenis->keterangan }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label for="jenis" class="form-label">Kategori</label>
                <select id="jenis" name="jenis" class="form-select">
                  <option selected disabled value="">Choose...</option>
                  <option value="Debit" {{ Request::get('jenis') == 'Debit' ? 'selected':''}}>Debit | Pemasukan</option>
                  <option value="Kredit" {{ Request::get('jenis') == 'Kredit' ? 'selected':''}}>Kredit | Pengeluaran</option>
                </select>
              </div>
              <div class="col-md-2">
                <label for="" class="form-label">Mulai</label>
                <input type="date" name="date_from" class="form-control" value="{{ $request->date_from }}">
              </div>
              <div class="col-md-2">
                <label for="" class="form-label">Sampai</label>
                <input type="date" name="date_to" class="form-control" value="{{ $request->date_to }}">
              </div>
            </div>
            <div class="text-center">
              <a type="submit" class="btn btn-secondary" href="{{ url('laporan')}}">Reset</a>
              <input type="submit" class="btn btn-primary" value="Search">
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
          @include('Laporan.table',$data)
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('js')

@endsection