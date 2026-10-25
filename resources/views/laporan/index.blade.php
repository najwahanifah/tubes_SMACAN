@extends('layouts.app')

@section('content')
<div class="topbar">
    <div class="page-title">
        <h1>Laporan Saya</h1>
        <p>Riwayat laporan kondisi tong sampah yang kamu upload</p>
    </div>
    <div class="topbar-right">
        <a class="notif-btn" href="#"><i class="ti ti-bell" aria-hidden="true"></i><div class="notif-dot"></div></a>
    </div>
</div>

@include('partials.flash')

@forelse ($daftarLaporan as $lap)
    @php
        $badgeClass = match ($lap->status) { 'penuh' => 'badge-red', 'sedang' => 'badge-amber', default => 'badge-green' };
    @endphp
    <div class="laporan-card-list" id="laporan-{{ $lap->id }}">
        <div class="laporan-thumb">
            @if ($lap->foto)
                <img src="{{ asset('uploads/laporan/'.$lap->foto) }}" alt="Foto laporan">
            @else
                <i class="ti ti-trash" aria-hidden="true"></i>
            @endif
        </div>
        <div class="laporan-card-body">
            <div class="laporan-card-title">{{ $lap->tong->nama_tong ?? '-' }} <span class="lokasi-status {{ $badgeClass }}" style="margin-left:6px">{{ ucfirst($lap->status) }}</span></div>
            <div class="laporan-card-meta">{{ $lap->tong->lokasi ?? '-' }} &middot; {{ $lap->created_at->diffForHumans() }} &middot; +{{ $lap->poin_didapat }} poin</div>
            @if ($lap->keterangan)
                <div class="laporan-card-desc">{{ $lap->keterangan }}</div>
            @endif
            <div class="laporan-card-actions">
                <a href="{{ route('laporan.edit', $lap->id) }}" class="btn-secondary"><i class="ti ti-edit" style="font-size:13px;vertical-align:-2px" aria-hidden="true"></i> Edit</a>
                <form action="{{ route('laporan.destroy', $lap->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger"><i class="ti ti-trash" style="font-size:13px;vertical-align:-2px" aria-hidden="true"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="empty-state">
        <i class="ti ti-clipboard-off" aria-hidden="true"></i>
        Kamu belum membuat laporan apapun. Yuk mulai lapor kondisi tong sampah!
    </div>
@endforelse

<a href="{{ route('laporan.create') }}" class="fab-add">
    <i class="ti ti-plus" aria-hidden="true"></i> Lapor Sampah
</a>
@endsection
