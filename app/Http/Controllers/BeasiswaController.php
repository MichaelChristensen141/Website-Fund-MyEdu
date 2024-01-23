<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Perusahaan;
use App\Models\Kampus;
use App\Models\Beasiswa;
use App\Models\Jurusan;
use App\Models\Jenjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Jobs\CrawlingBeasiswa;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crawling = DB::table('jobs')->count();
        $beasiswa = Beasiswa::orderBy('BeasiswaID', 'DESC')->paginate(10);
        $original = Beasiswa::whereNull('CrawlingId')->count(); // Menghitung jumlah data dengan CrawlingId null
        $thirdParty = Beasiswa::whereNotNull('CrawlingId')->count(); // Menghitung jumlah data dengan CrawlingId tidak null

        $data = [
            'title' => "Buat Beasiswa",
            'beasiswa' => $beasiswa,
            'crawlingCount' => $crawling,
            'original' => $original,
            'thirdParty' => $thirdParty
        ];

        return view('beasiswa.index', $data);
    }


    public function crawling()
    {
        $client = new \GuzzleHttp\Client();

        foreach (range(1, ENV('API_COUNT')) as $index) {
            $name = 'API_NAME' . $index;
            $link = 'API_LINK' . $index;


            try {
                $response = $client->get(ENV($link) . '/api/beasiswa');

                $body = json_decode($response->getBody(), true);

                foreach ($body as $key) {
                    $beasiswa = Beasiswa::where('CrawlingId', $key['BeasiswaID'])->where('Source', ENV($name))->first();
                    if (!$beasiswa) {
                        // Jika ada model Beasiswa yang sesuai, lakukan pekerjaan dalam antrian
                        CrawlingBeasiswa::dispatch($key['BeasiswaID'], $index);
                    }
                }
               
            } catch (RequestException $exception) {
                $responseBody = $exception->getResponse()->getBody(true);

                Session::flash('error', 'Beasiswa Failed to add to Crawl Engine: ' . $exception->getMessage());
                return redirect()->route('dashboard.beasiswa.index');
            }
        }

        Session::flash('success', 'Beasiswa successfully add to Crawl Enggine');
        return redirect()->route('dashboard.beasiswa.index');
    }

    public function crawlingOne($id)
    {
        $client = new \GuzzleHttp\Client();

        $name = 'API_NAME' . $id;
        $link = 'API_LINK' . $id;


        try {
            $response = $client->get(ENV($link) . '/api/beasiswa');

            $body = json_decode($response->getBody(), true);

            foreach ($body as $key) {
                $beasiswa = Beasiswa::where('CrawlingId', $key['BeasiswaID'])->where('Source', ENV($name))->first();
                if (!$beasiswa) {
                    // Jika ada model Beasiswa yang sesuai, lakukan pekerjaan dalam antrian
                    CrawlingBeasiswa::dispatch($key['BeasiswaID'], $id);
                }
            }
            Session::flash('success', 'Beasiswa successfully add to Crawl Enggine');
            return redirect()->route('dashboard.beasiswa.index');
        } catch (RequestException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);

            Session::flash('error', 'Beasiswa Failed to add to Crawl Engine: ' . $exception->getMessage());
            return redirect()->route('dashboard.beasiswa.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perusahaan = Perusahaan::all();
        $kampus = Kampus::all();
        $jurusan = Jurusan::all();
        $jenjang = Jenjang::all();
        $data = [
            'title' => "Buat Beasiswa",
            'perusahaan' => $perusahaan,
            'kampus' => $kampus,
            'jurusan' => $jurusan,
            'jenjang' => $jenjang,
        ];
        return view('beasiswa.create', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {


            $validatedData = $request->validate([
                'NamaBeasiswa' => 'required|string',
                'Deskripsi' => 'required|string',
                'Persyaratan' => 'required|string',
                'TanggalPendaftaran' => 'required|date',
                'TanggalPenutupan' => 'required|date|after_or_equal:TanggalPendaftaran',
                'TahunMasuk' => 'required|integer|min:1900',
                'Pembiayaan' => 'required|string',
                'JumlahPenerima' => 'required|integer|min:1',
                'Kontak' => 'required|string',
                'TipeBeasiswa' => 'required|in:Kampus,Non-Kampus',
                'KampusID' => 'required_if:TipeBeasiswa,Kampus|exists:kampus,KampusID',
                'PerusahaanID' => 'required_if:TipeBeasiswa,Non-Kampus|exists:perusahaan,PerusahaanID',
                'jenjang' => 'required|array|min:1|max:6',
                'jurusan' => 'required|array|min:1|max:6',
            ]);

            $beasiswa = Beasiswa::create($validatedData);
            $beasiswaID = $beasiswa->id;

            $jenjangIDs = $request->input('jenjang');
            $jurusanIDs = $request->input('jurusan');

            $beasiswa->jenjang()->attach($jenjangIDs);
            $beasiswa->jurusan()->attach($jurusanIDs);

            DB::commit();

            Session::flash('success', 'Beasiswa created successfully');
            return redirect()->route('dashboard.beasiswa.index');
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', 'Failed to create beasiswa: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $validatedData = $request->validate([
                'NamaBeasiswa' => 'required|string',
                'Deskripsi' => 'required|string',
                'Persyaratan' => 'required|string',
                'TanggalPendaftaran' => 'required|date',
                'TanggalPenutupan' => 'required|date|after_or_equal:TanggalPendaftaran',
                'TahunMasuk' => 'required|integer|min:1900',
                'Pembiayaan' => 'required|string',
                'JumlahPenerima' => 'required|integer|min:1',
                'Kontak' => 'required|string',
                'TipeBeasiswa' => 'required|in:Kampus,Non-Kampus',
                'KampusID' => 'required_if:TipeBeasiswa,Kampus|exists:kampus,KampusID',
                'PerusahaanID' => 'required_if:TipeBeasiswa,Non-Kampus|exists:perusahaan,PerusahaanID',
                'jenjang' => 'required|array|min:1|max:6',
                'jurusan' => 'required|array|min:1|max:6',
            ]);


            $beasiswa = Beasiswa::findOrFail($id);
            $beasiswa->update($validatedData);

            $jenjangIDs = $request->input('jenjang');
            $jurusanIDs = $request->input('jurusan');

            $beasiswa->jenjang()->sync($jenjangIDs);
            $beasiswa->jurusan()->sync($jurusanIDs);

            DB::commit();

            Session::flash('success', 'Beasiswa updated successfully');
            return redirect()->route('dashboard.beasiswa.index');
        } catch (\Exception $e) {
            DB::rollback();

            Session::flash('error', 'Failed to update beasiswa');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $perusahaan = Perusahaan::all();
        $kampus = Kampus::all();
        $jurusan = Jurusan::all();
        $jenjang = Jenjang::all();

        $data = [
            'title' => "Edit Beasiswa",
            'beasiswa' => $beasiswa,
            'perusahaan' => $perusahaan,
            'kampus' => $kampus,
            'jurusan' => $jurusan,
            'jenjang' => $jenjang,
        ];

        return view('beasiswa.edit', $data);
    }

    public function destroy($id)
    {
        try {
            $beasiswa = Beasiswa::findOrFail($id);
            $beasiswa->delete();

            Session::flash('success', 'Beasiswa deleted successfully');
            return redirect()->route('dashboard.beasiswa.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to delete beasiswa: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
