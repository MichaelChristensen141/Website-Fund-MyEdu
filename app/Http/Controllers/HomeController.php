<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Jenjang;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function index()
    {
        $today = Carbon::now()->toDateString();
        $beasiswa = Beasiswa::orderBy('BeasiswaID', 'DESC')->whereDate('TanggalPendaftaran', '>=', $today)->paginate(9);

        $data = [
            'title' => "Beranda",
            'beasiswa' => $beasiswa,
        ];
        return view('home.index', $data);
    }

    public function show_beasiswa($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId); // Mendekripsi ID menggunakan metode decrypt()

            // Cari data beasiswa berdasarkan ID
            $beasiswa = Beasiswa::find($id);

            // Jika data tidak ditemukan
            if (!$beasiswa) {
                // Lakukan logika untuk menangani kasus jika data tidak ditemukan
                return Redirect::route('index')->with('error', 'Data beasiswa tidak ditemukan.');
            }

            $beasiswa = Beasiswa::find($id);


            // Kembalikan response, tampilkan view, dll.
            return view('home.show', compact('beasiswa'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Lakukan penanganan kesalahan jika gagal mendekripsi ID
            return Redirect::route('index')->with('error', 'Kesalahan dalam mendekripsi ID beasiswa.');
        }
    }

    public function list_beasiswa(Request $request)
    {
        $keywords = $request->query('keywords');
        $insitusi = $request->query('insitusi');
        $type = $request->query('type');

        $query = Beasiswa::query();
        $today = Carbon::now()->toDateString();

        // Filter berdasarkan nama beasiswa atau kata kunci
        if ($keywords) {
            $query->where('NamaBeasiswa', 'like', '%' . $keywords . '%');
        }

        if ($insitusi === 'Kampus') {
            $query->whereHas('kampus', function ($q) use ($insitusi) {
                $q->where('NamaKampus', 'like', '%' . $insitusi . '%');
            });
        } elseif ($insitusi === 'Non-Kampus') {
            $query->whereHas('perusahaan', function ($q) use ($insitusi) {
                $q->where('NamaPerusahaan', 'like', '%' . $insitusi . '%');
            });
        }



        if ($type === 'Kampus') {
            $query->where('TipeBeasiswa', 'Kampus');
        } elseif ($type === 'Non-Kampus') {
            $query->where('TipeBeasiswa', 'Non-Kampus');
        }

        $beasiswa = $query
            ->orderBy('BeasiswaID', 'DESC')
            ->whereDate('TanggalPendaftaran', '<=', now()->toDateString())
            ->whereDate('TanggalPenutupan', '>=', now()->toDateString())
            ->paginate(10);

        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();
        $data = [
            'title' => "List Beasiswa",
            'beasiswa' => $beasiswa,
            'jenjang' => $jenjang,
            'jurusan' => $jurusan,
        ];
        return view('home.list', $data);
    }

    public function rekomendasi_beasiswa(Request $request)
    {

        $keywords = $request->query('keywords');
        if (auth()->user()->roles->pluck('name')[0] != 'admin') {
            $jurusan = auth()->user()->jurusan->NamaJurusan;
            $jenjang = auth()->user()->Jenjang->NamaJenjang;
            $type = $request->query('type');

            $query = Beasiswa::query();
            $today = Carbon::now()->toDateString();

            // Filter berdasarkan nama beasiswa atau kata kunci
            if ($keywords) {
                $query->where('NamaBeasiswa', 'like', '%' . $keywords . '%');
            }


            $query->whereHas('jurusan', function ($q) use ($jurusan) {
                $q->where('NamaJurusan', $jurusan);
            });

            $query->whereHas('jenjang', function ($q) use ($jenjang) {
                $q->where('NamaJenjang', $jenjang);
            });
        } else {
            $query = Beasiswa::query();
            $today = Carbon::now()->toDateString();
        }


        $beasiswa = $query
            ->orderBy('BeasiswaID', 'DESC')
            ->whereDate('TanggalPendaftaran', '<=', now()->toDateString())
            ->whereDate('TanggalPenutupan', '>=', now()->toDateString())
            ->paginate(10);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();
        $data = [
            'title' => "Rekomendasi Beasiswa",
            'beasiswa' => $beasiswa,
            'jenjang' => $jenjang,
            'jurusan' => $jurusan,
        ];
        return view('home.rekomendasi', $data);
    }

    public function about()
    {
        $data = [
            'title' => "Tentang Kami"
        ];
        return view('home.about', $data);
    }
}
