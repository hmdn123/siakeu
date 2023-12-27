@extends('Template.app')

@section('content')

<div class="pagetitle">
  <h1>Laporan Pemasukan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
      <li class="breadcrumb-item">Laporan</li>
      <li class="breadcrumb-item active">Pemasukan</li>
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row dashboard">
    <!-- Left side columns -->
    <div class="col-lg-12">
      <!-- Revenue Card -->
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Revenue</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-cash-stack"></i>
            </div>
            <div class="ps-3">
              <h6>@currency($total_pemasukan)</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Pemasukan</h5>
          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tgl</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Debit</th>
                <th scope="col">Account</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($history_pemasukan as $data)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>@currency($data->nominal)</td>
                <td>{{ $data->user->name }}</td>
              </tr>
              @empty
              <div class="alert alert-danger">
                Data Transaksi belum Tersedia.
              </div>

              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection