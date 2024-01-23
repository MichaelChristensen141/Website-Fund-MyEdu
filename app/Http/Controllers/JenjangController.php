<?php

namespace App\Http\Controllers;
use App\Models\Jenjang; 
use Illuminate\Http\Request;

class JenjangController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenjang = Jenjang::orderBy('JenjangID','DESC')->paginate(10); // Menggunakan paginasi dengan 10 item per halaman
        $data = [
            'title' => "Jenjang",
            'jenjang' => $jenjang
        ];
        return view('masterdata.jenjang.index', $data);
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
            'NamaJenjang' => 'required',
            'Deskripsi' => 'required',
        ]);

        // Buat objek Jenjang baru
        $Jenjang = new Jenjang();
        $Jenjang->NamaJenjang = $request->NamaJenjang;
        $Jenjang->Deskripsi = $request->Deskripsi;

        if ($Jenjang->save()) {
            return redirect()->route('masterdata.jenjang.index')->with('success', 'Jenjang berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan Jenjang. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenjang  $Jenjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaJenjang' => 'required',
            'Deskripsi' => 'required',
        ]);
    
        $Jenjang = Jenjang::find($id);
    
        if (!$Jenjang) {
            return redirect()->route('masterdata.jenjang.index')->with('error', 'Jenjang tidak ditemukan');
        }
    
        $Jenjang->NamaJenjang = $request->NamaJenjang;
        $Jenjang->Deskripsi = $request->Deskripsi;
        $Jenjang->save();
    
        return redirect()->route('masterdata.jenjang.index')->with('success', 'Jenjang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenjang  $jenjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenjang = Jenjang::findOrFail($id);
        try {
            $jenjang->delete();
            return redirect()->route('masterdata.jenjang.index')->with('success', 'Jenjang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Gagal menghapus Jenjang. Jenjang terkait masih ada.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus Jenjang. Terjadi kesalahan: ' . $e->getMessage());
            }
        }
        
        
    }
}
