@extends('Template.app')

@section('content')

<div class="pagetitle">
  <h1>Laporan Pemasukan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
      <li class="breadcrumb-item">Laporan</li>
      <li class="breadcrumb-item active">All</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Download :
            <div class=" float-end">
              Pdf : 
              <a href="{{ url('/laporan/view/pdf' )}}"  target="_blank" class="btn btn-warning btn-sm"><i class="bi bi-eye-fill"></i></a>
              <a href="{{ url('/laporan/download/pdf' )}}" class="btn btn-warning btn-sm"><i class="bi bi-download"></i></a>
               | Excel : 
              <a href="{{ url('/laporan/download/excel' )}}" class="btn btn-primary btn-sm"><i class="bi bi-download"></i></a>
            </div>
          </h5>
          <br>
          @include('Laporan.All.table',$transaksi)
        </div>
      </div>
    </div>
  </div>
</section>

@endsection