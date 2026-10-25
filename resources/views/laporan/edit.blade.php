@extends('layouts.app')

@section('content')
<div class="topbar">
    <div class="page-title">
        <h1>Edit Laporan</h1>
        <p>Perbarui data laporan kondisi tong sampah</p>
    </div>
    <div class="topbar-right">
        <a class="notif-btn" href="#"><i class="ti ti-bell" aria-hidden="true"></i><div class="notif-dot"></div></a>
    </div>
</div>

@include('partials.flash')

<div class="form-card">
    @if ($laporan->foto)
        <div class="form-group">
            <label>Foto Saat Ini</label>
            <div class="laporan-thumb" style="width:100px;height:100px">
                <img src="{{ asset('uploads/laporan/'.$laporan->foto) }}" alt="Foto laporan">
            </div>
        </div>
    @endif

    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tong_id">Lokasi Tong Sampah</label>
            <select id="tong_id" name="tong_id" class="form-control" required>
                @foreach ($daftarTong as $tong)
                    <option value="{{ $tong->id }}" @selected((int) old('tong_id', $laporan->tong_id) === (int) $tong->id)>
                        {{ $tong->nama_tong }} — {{ $tong->lokasi }}
                    </option>
                @endforeach
            </select>
        </div>

        @php($statusSaatIni = old('status', $laporan->status))
        <div class="form-group">
            <label for="status">Status Kondisi</label>
            <select id="status" name="status" class="form-control" required>
                <option value="kosong" @selected($statusSaatIni === 'kosong')>Kosong</option>
                <option value="sedang" @selected($statusSaatIni === 'sedang')>Sedang (terisi sebagian)</option>
                <option value="penuh"  @selected($statusSaatIni === 'penuh')>Penuh</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan (opsional)</label>
            <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $laporan->keterangan) }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Ganti Foto (opsional)</label>
            <input type="file" id="foto" name="foto" class="form-control" accept="image/jpeg,image/png,image/webp">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary"><i class="ti ti-device-floppy" aria-hidden="true"></i> Simpan Perubahan</button>
            <a href="{{ route('laporan.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
