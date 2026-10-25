<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{LaporanSampah, TongSampah};
use Illuminate\Support\Facades\{Auth, DB};

class LaporanController extends Controller
{

public function index()
{
    $daftarLaporan = Auth::user()->laporan()->with('tong')->latest()->get();
    return view('laporan.index', compact('daftarLaporan'));
}

public function create()
{
    return view('laporan.create', ['daftarTong' => TongSampah::orderBy('nama_tong')->get()]);
}

public function store(Request $request)
{
    $data = $request->validate([
        'tong_id'    => 'required|exists:tong_sampah,id',
        'status'     => 'required|in:kosong,sedang,penuh',
        'keterangan' => 'nullable|string',
        'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $foto = $this->simpanFoto($request);
    $poin = $foto ? 10 : 5;

    DB::transaction(function () use ($data, $foto, $poin) {
        Auth::user()->laporan()->create([
            'tong_id' => $data['tong_id'], 'status' => $data['status'],
            'keterangan' => $data['keterangan'] ?? null, 'foto' => $foto, 'poin_didapat' => $poin,
        ]);
        TongSampah::whereKey($data['tong_id'])->update(['status' => $data['status']]);
        Auth::user()->increment('total_poin', $poin);
    });

    return redirect()->route('laporan.index')->with('success', "Laporan berhasil dikirim! +{$poin} poin didapat.");
}

public function edit($id)
{
    return view('laporan.edit', [
        'laporan'    => Auth::user()->laporan()->findOrFail($id),
        'daftarTong' => TongSampah::orderBy('nama_tong')->get(),
    ]);
}

public function update(Request $request, $id)
{
    $laporan = Auth::user()->laporan()->findOrFail($id);
    $data = $request->validate([
        'tong_id' => 'required|exists:tong_sampah,id',
        'status'  => 'required|in:kosong,sedang,penuh',
        'keterangan' => 'nullable|string',
        'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($fotoBaru = $this->simpanFoto($request)) {
        if ($laporan->foto) @unlink(public_path('uploads/laporan/'.$laporan->foto));
        $laporan->foto = $fotoBaru;
    }
    $laporan->fill([
        'tong_id' => $data['tong_id'], 'status' => $data['status'],
        'keterangan' => $data['keterangan'] ?? null,
    ])->save();
    TongSampah::whereKey($data['tong_id'])->update(['status' => $data['status']]);

    return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
}

public function destroy($id)
{
    $laporan = Auth::user()->laporan()->findOrFail($id);
    if ($laporan->foto) @unlink(public_path('uploads/laporan/'.$laporan->foto));
    $laporan->delete();
    return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
}

private function simpanFoto(Request $request): ?string
{
    if (!$request->hasFile('foto')) return null;
    $file = $request->file('foto');
    $nama = 'laporan_'.uniqid().'_'.time().'.'.$file->extension();
    $file->move(public_path('uploads/laporan'), $nama);
    return $nama;
}
}
