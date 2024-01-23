<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Exception\RequestException;
use App\Models\Beasiswa;
use App\Models\Perusahaan;
use App\Models\Jenjang;
use App\Models\Jurusan;
use App\Models\Kampus;

use Illuminate\Support\Facades\DB;

class CrawlingBeasiswa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $beasiswaID,$ID;
    /**
     * Create a new job instance.
     */
    public function __construct($beasiswaID,$ID)
    {
        $this->beasiswaID = $beasiswaID;
        $this->ID = $ID;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $beasiswaID = $this->beasiswaID;
        $client = new \GuzzleHttp\Client();

        
        $name = 'API_NAME' . $this->ID;
        $link = 'API_LINK' . $this->ID;

        try {
            $response = $client->get(ENV($link) . "/api/beasiswa/$beasiswaID");
           

            $body = json_decode($response->getBody(), true);
        } catch (RequestException $exception) {
            $responseBody = $exception->getResponse()->getBody(true);

            response($responseBody, $exception->getCode());
        }

        $jsonData = $body;
        $jsonData['CrawlingId'] = $jsonData['BeasiswaID'];
        $jsonData['Source'] = ENV($name);

        
        DB::beginTransaction();

        try {
            // Update or create Beasiswa
            $beasiswa = Beasiswa::updateOrCreate(
                [
                    'CrawlingId' => $jsonData['CrawlingId'],
                    'Source' => ENV($name)
                ],
             $jsonData);

            // Update or create Perusahaan if present
            if (isset($jsonData['perusahaan'])) {
                $perusahaanData = $jsonData['perusahaan'];
                if (isset($perusahaanData['PerusahaanID'])) {
                    unset($perusahaanData['PerusahaanID']);
                }
                $perusahaan = Perusahaan::updateOrCreate(['NamaPerusahaan' => $perusahaanData['NamaPerusahaan']], $perusahaanData);
                $beasiswa->perusahaan()->associate($perusahaan);
                $beasiswa->save();
            }

            // Update or create Jenjang if present
            if (isset($jsonData['jenjang'])) {
                $jenjangData = $jsonData['jenjang'];
                $jenjangIds = [];
                foreach ($jenjangData as $data) {
                    $jenjang = Jenjang::updateOrCreate(['NamaJenjang' => $data['NamaJenjang']], $data);
                    $jenjangIds[] = $jenjang->JenjangID;
                }
                $beasiswa->jenjang()->sync($jenjangIds);
            }

            // Update or create Jurusan if present
            if (isset($jsonData['jurusan'])) {
                $jurusanData = $jsonData['jurusan'];
                $jurusanIds = [];
                foreach ($jurusanData as $data) {
                    $jurusan = Jurusan::updateOrCreate(['NamaJurusan' => $data['NamaJurusan']], $data);
                    $jurusanIds[] = $jurusan->JurusanID;
                }
                $beasiswa->jurusan()->sync($jurusanIds);
            }

            // Update or create Kampus if present
            if (isset($jsonData['kampus'])) {
                $kampusData = $jsonData['kampus'];
                if (isset($kampusData['KampusnID'])) {
                    unset($kampusData['KampusnID']);
                }
                $kampus = Kampus::updateOrCreate(['KampusID' => $kampusData['KampusID']], $kampusData);
                $beasiswa->kampus()->associate($kampus);
                $beasiswa->save();
            }

            DB::commit();
            // sleep(5);
        } catch (\Exception $e) {
            DB::rollBack();
            // sleep(5);
        }
    }
}
