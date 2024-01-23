<?php

namespace App\Http\Controllers;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public $path = 'images/perusahaan/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Perusahaan::orderBy('PerusahaanID','DESC')->paginate(10); // Menggunakan paginasi dengan 10 item per halaman
        $data = [
            'title' => "Perusahaan",
            'perusahaan' => $perusahaan
        ];
        return view('masterdata.perusahaan.index', $data);
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
            'NamaPerusahaan' => 'required',
            'Alamat' => 'required',
            'Kontak' => 'required',
            'Website' => 'required',
        ]);


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Create the image name
            $imageName = $request->file('image')->getClientOriginalName();
            $imageName = $request->input('NamaPerusahaan') . '-' . time() . '.' . $request->file('image')->extension();
        
            // Move the image to the public folder
            $imagePath = $request->file('image')->storeAs('public/'.$this->path, $imageName);
        
            // Check if the image was not saved
            if (!$imagePath) {
                return redirect()->back()->with('error', 'Gagal menambahkan kampus. Silakan coba lagi.');
            }

            $request->image = $this->path . $imageName;
          
        }

        // Buat objek perusahaan baru
        $perusahaan = new Perusahaan();
        $perusahaan->NamaPerusahaan = $request->NamaPerusahaan;
        $perusahaan->Alamat = $request->Alamat;
        $perusahaan->Kontak = $request->Kontak;
        $perusahaan->Website = $request->Website;
        $perusahaan->Gambar = $request->image;

        if ($perusahaan->save()) {
            return redirect()->route('masterdata.perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan Perusahaan. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaPerusahaan' => 'required',
            'Alamat' => 'required',
            'Kontak' => 'required',
            'Website' => 'required',
        ]);

    
        $perusahaan = Perusahaan::find($id);
    
        if (!$perusahaan) {
            return redirect()->route('masterdata.perusahaan.index')->with('error', 'Perusahaan tidak ditemukan');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Create the image name
            $imageName = $request->file('image')->getClientOriginalName();
            $imageName = $request->input('NamaPerusahaan') . '-' . time() . '.' . $request->file('image')->extension();
        
            // Move the image to the public folder
            $imagePath = $request->file('image')->storeAs('public/'.$this->path, $imageName);
        
            // Check if the image was not saved
            if (!$imagePath) {
                return redirect()->back()->with('error', 'Gagal menambahkan kampus. Silakan coba lagi.');
            }

            $request->image = $this->path . $imageName;

            $perusahaan->NamaPerusahaan = $request->NamaPerusahaan;
            $perusahaan->Alamat = $request->Alamat;
            $perusahaan->Kontak = $request->Kontak;
            $perusahaan->Website = $request->Website;
            $perusahaan->Gambar = $request->image;
            $perusahaan->save();
        
            return redirect()->route('masterdata.kampus.index')->with('success', 'Kampus berhasil diperbarui');
          
        }else{
            $perusahaan->NamaPerusahaan = $request->NamaPerusahaan;
            $perusahaan->Alamat = $request->Alamat;
            $perusahaan->Kontak = $request->Kontak;
            $perusahaan->Website = $request->Website;
            $perusahaan->save();
        
            return redirect()->route('masterdata.perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui');
    
        }
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan,$id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        try {
            $perusahaan->delete();
            return redirect()->route('masterdata.perusahaan.index')->with('success', 'Perusahaan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Gagal menghapus Perusahaan. Perusahaan terkait masih ada.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus Perusahaan. Terjadi kesalahan: ' . $e->getMessage());
            }
        }
        
        
    }
}