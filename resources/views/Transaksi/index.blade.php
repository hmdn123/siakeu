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

@if (!$jenis->isEmpty())
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Transaksi
            <br>
            <span>Input setiap pemasukan dan pengeluaran yang dilakukan.</span>
          </h5>
          <form action="{{ url('transaksi/store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label for="keterangan" class="form-label">Jenis Transaksi</label>
                <select name="keterangan" class="form-select @error('keterangan') is-invalid @enderror" id="jenis">
                  <option selected disabled value="">Choose...</option>
                  @foreach ( $jenis as $jenis )
                  <option value="{{ $jenis->keterangan }}" data-kode="{{ $jenis->kode }}" data-kode2="{{ $jenis->kode }}">{{ $jenis->keterangan }}</option>
                  @endforeach
                </select>
                <!-- error message untuk jenis -->
                @error('keterangan')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="col-md-4">
                <label for="kode2" class="form-label">Kode Transaksi</label>
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control col-md-6 value=" {{ old('kode2') }}" id="kode2" disabled="">
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="form-control value=" {{ old('kode') }}" id="kode" name="kode" style="visibility: hidden;">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="jenis" class="form-label">Kategori Transaksi</label>
                <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                  <option selected disabled value="">Choose...</option>
                  <option value="Debit">Debit | Pemasukan</option>
                  <option value="Kredit">Kredit | Pengeluaran</option>
                </select>
                <!-- error message untuk jenis -->
                @error('jenis')
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="detail" class="form-label">Uraian</label>
                <input type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('detail') }}" id="detail">
                <!-- error message untuk detail -->
                @error('detail')
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
              <div class="col-md-2">
                <div class="text-center">
                  <br>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
          </form><!-- End Multi Columns Form -->
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">SALDO</h5>
          <h1>@currency($saldo_akhir)</h1>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body mt-3">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Total Pemasukan :</th>
                <td></td>
              </tr>
              <tr>
                <td style="text-align: right;" colspan="2"> @currency($total_pemasukan)</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Total Pengeluaran :</th>
                <td></td>
              </tr>
              <tr>
                <td style="text-align: right;" colspan="2"> @currency($total_pengeluaran)</td>
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
                <th scope="col">Kode</th>
                <th scope="col">Jenis</th>
                <th scope="col">Uraian</th>
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
                <td>{{ $transaksi->kode }}</td>
                <td>{{ $transaksi->keterangan }}</td>
                <td>{{ $transaksi->detail }}</td>
                @if ($transaksi->jenis === "Debit")
                <td>@currency($transaksi->nominal)</td>
                <td></td>
                @else
                <td></td>
                <td>@currency($transaksi->nominal)</td>
                @endif
                <td>{{ $transaksi->user->name }}</td>
                <td>
                  @if ($transaksi->user->name === Auth::user()->name )
                  <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('transaksi/delete', $transaksi->id) }}" method="POST">
                    <a href="{{ url('transaksi/edit', $transaksi->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                  </form>
                  @else
                  <p style="text-align: center;"><b> No Akses </b></p>
                  @endif

                </td>
              </tr>
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
@else
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card border-danger">
        <div class="card-body">
          <h5 class="card-title">PEMBERITAHUAN
            <br>
            <span>Silahkan Ke Menu SETTING -> JENIS TRANSAKSI. <br>
              Untuk melakukan penyetingan terlebih dahulu.
            </span>
          </h5>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@endsection

@section('js')
<script>
  $(document).ready(function() {
    $('#jenis').on('change', function() {
      const selected = $(this).find('option:selected');
      const kode = selected.data('kode');
      const kode2 = selected.data('kode2');

      $("#kode").val(kode);
      $("#kode2").val(kode2);
    });
  });
</script>
<script>
  //message with toastr
  @if(session()->has('success'))
    toastr.success('{{ session('success ') }}', 'BERHASIL!');
  @elseif(session()->has('error'))
    toastr.error('{{ session('error ') }}', 'GAGAL!');
  @endif
</script>
@endsection