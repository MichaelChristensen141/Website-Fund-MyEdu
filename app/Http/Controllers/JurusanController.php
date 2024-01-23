<?php

namespace App\Http\Controllers;
use App\Models\Jurusan;
use App\Models\Jenjang;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::orderBy('JurusanID','DESC')->paginate(10);
        $jenjang = Jenjang::all(); 
        $data = [
            'title' => "Jurusan",
            'jurusan' => $jurusan,
            'jenjang' => $jenjang,
        ];
        return view('masterdata.jurusan.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'NamaJurusan' => 'required',
            'Deskripsi' => 'required',
            'JenjangID' => 'required',
        ]);

        // Buat objek Jurusan baru
        $jurusan = new Jurusan();
        $jurusan->NamaJurusan = $request->NamaJurusan;
        $jurusan->Deskripsi = $request->Deskripsi;
        $jurusan->JenjangID = $request->JenjangID;


        if ($jurusan->save()) {
            return redirect()->route('masterdata.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan Jurusan. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaJurusan' => 'required',
            'Deskripsi' => 'required',
            'JenjangID' => 'required',
        ]);

    
        $jurusan = Jurusan::find($id);
    
        if (!$jurusan) {
            return redirect()->route('masterdata.jurusan.index')->with('error', 'Jurusan tidak ditemukan');
        }
    
        $jurusan->NamaJurusan = $request->NamaJurusan;
        $jurusan->Deskripsi = $request->Deskripsi;
        $jurusan->JenjangID = $request->JenjangID;
        $jurusan->save();
    
        return redirect()->route('masterdata.jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        try {
            $jurusan->delete();
            return redirect()->route('masterdata.jurusan.index')->with('success', 'Jurusan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Gagal menghapus Jurusan. Jurusan terkait masih ada.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus Jurusan. Terjadi kesalahan: ' . $e->getMessage());
            }
        }
        
    }

    public function getJurusanByJenjangID(Request $request)
    {
        $jenjangID = $request->input('jenjangID');
        
        $jurusan = Jurusan::where('JenjangID', $jenjangID)->get();

        return response()->json($jurusan);
    }
}
