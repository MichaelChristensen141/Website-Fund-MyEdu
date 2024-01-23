<?php

namespace App\Http\Controllers;
use App\Models\Kampus;
use Illuminate\Http\Request;

class KampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $path = 'images/kampus/';

    public function index()
    {
        $kampus = Kampus::orderBy('KampusID','DESC')->paginate(10); // Menggunakan paginasi dengan 10 item per halaman
        $data = [
            'title' => "Kampus",
            'kampus' => $kampus
        ];
        return view('masterdata.kampus.index', $data);
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
            'NamaKampus' => 'required',
            'Alamat' => 'required',
            'Kontak' => 'required',
            'Website' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);



        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Create the image name
            $imageName = $request->file('image')->getClientOriginalName();
            $imageName = $request->input('NamaKampus') . '-' . time() . '.' . $request->file('image')->extension();
        
            // Move the image to the public folder
            $imagePath = $request->file('image')->storeAs('public/'.$this->path, $imageName);
        
            // Check if the image was not saved
            if (!$imagePath) {
                return redirect()->back()->with('error', 'Gagal menambahkan kampus. Silakan coba lagi.');
            }

            $request->image = $this->path . $imageName;
          
        }
        
        // Buat objek kampus baru
        $kampus = new Kampus();
        $kampus->NamaKampus = $request->NamaKampus;
        $kampus->Alamat = $request->Alamat;
        $kampus->Kontak = $request->Kontak;
        $kampus->Website = $request->Website;
        $kampus->Gambar = $request->image;

        if ($kampus->save()) {
            return redirect()->route('masterdata.kampus.index')->with('success', 'Kampus berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan kampus. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kampus  $kampus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaKampus' => 'required',
            'Alamat' => 'required',
            'Kontak' => 'required',
            'Website' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $kampus = Kampus::find($id);
    
        if (!$kampus) {
            return redirect()->route('masterdata.kampus.index')->with('error', 'Kampus tidak ditemukan');
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Create the image name
            $imageName = $request->file('image')->getClientOriginalName();
            $imageName = $request->input('NamaKampus') . '-' . time() . '.' . $request->file('image')->extension();
        
            // Move the image to the public folder
            $imagePath = $request->file('image')->storeAs('public/'.$this->path, $imageName);
        
            // Check if the image was not saved
            if (!$imagePath) {
                return redirect()->back()->with('error', 'Gagal menambahkan kampus. Silakan coba lagi.');
            }

            $request->image = $this->path . $imageName;

            $kampus->NamaKampus = $request->NamaKampus;
            $kampus->Alamat = $request->Alamat;
            $kampus->Kontak = $request->Kontak;
            $kampus->Website = $request->Website;
            $kampus->Gambar =  $request->image;
            $kampus->save();
        
            return redirect()->route('masterdata.kampus.index')->with('success', 'Kampus berhasil diperbarui');
          
        }else{
            $kampus->NamaKampus = $request->NamaKampus;
            $kampus->Alamat = $request->Alamat;
            $kampus->Kontak = $request->Kontak;
            $kampus->Website = $request->Website;
            $kampus->save();
        
            return redirect()->route('masterdata.kampus.index')->with('success', 'Kampus berhasil diperbarui');
        }
    
       
    
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kampus  $kampus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kampus $kampus,$id)
    {
        $kampus = Kampus::findOrFail($id);
        try {
            $kampus->delete();
            return redirect()->route('masterdata.kampus.index')->with('success', 'Kampus berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Gagal menghapus kampus. Kampus terkait masih ada.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus kampus. Terjadi kesalahan: ' . $e->getMessage());
            }
        }
        
        
    }
}
