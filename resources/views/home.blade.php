@extends('Template.app')

@section('content')
@php
use App\Models\Transaksi;
@endphp
<div class="pagetitle">
  <h1>Home</h1>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">
    <div class="col-lg-4 dashboard">
      <!-- Revenue Card -->
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Total Pemasukan</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-arrow-up-right-circle"></i>
            </div>
            <div class="ps-3">
              <h6>@currency($total_pemasukan)</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 dashboard">
      <!-- Revenue Card -->
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Total Pengeluaran</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-arrow-down-right-circle"></i>
            </div>
            <div class="ps-3">
              <h6>@currency($total_pengeluaran)</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 dashboard">
      <!-- Revenue Card -->
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Saldo</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-cash-stack"></i>
            </div>
            <div class="ps-3">
              <h6>@currency($saldo_akhir)</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection