<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'prestasi' => 'required|string',
            'tahun' => 'required|numeric|gte:2000|lte:'.date('Y'),
        ]);
        

        // Dapatkan data pengguna yang sedang login
        $user = auth()->user();

        // Buat entri prestasi baru
        $prestasi = $user->riwayatPrestasi()->create([
            'prestasi' => $request->prestasi,
            'tahun' => $request->tahun,
        ]);

        if ($prestasi) {
            return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan prestasi. Silakan coba lagi.');
        }
    } 

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'prestasi' => 'required|string',
            'tahun' => 'required|numeric|gte:2000|lte:'.date('Y'),
        ]);

        // Dapatkan data pengguna yang sedang login
        $user = auth()->user();

        // Temukan riwayat prestasi berdasarkan id
        $riwayatPrestasi = $user->riwayatPrestasi()->where('id', $id)->first();

        if (!$riwayatPrestasi) {
            return redirect()->back()->with('error', 'Prestasi tidak ditemukan.');
        }

        // Perbarui data prestasi pengguna
        $riwayatPrestasi->prestasi = $request->prestasi;
        $riwayatPrestasi->tahun = $request->tahun;

        // Simpan perubahan
        $riwayatPrestasi->save();

        return redirect()->back()->with('success', 'Prestasi berhasil diperbarui.');
    }


    public function destroy($id)
    {
        // Dapatkan data pengguna yang sedang login
        $user = auth()->user();

        // Temukan riwayat prestasi berdasarkan id
        $riwayatPrestasi = $user->riwayatPrestasi()->where('id', $id)->first();

        if (!$riwayatPrestasi) {
            return redirect()->back()->with('error', 'Prestasi tidak ditemukan.');
        }

        // Hapus data prestasi
        $riwayatPrestasi->delete();

        return redirect()->back()->with('success', 'Prestasi berhasil dihapus.');
    }


}
