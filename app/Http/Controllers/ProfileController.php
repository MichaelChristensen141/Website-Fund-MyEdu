<?php

namespace App\Http\Controllers;
use App\Models\Verifikasi;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Jurusan;
use App\Models\Jenjang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{

    public $path = 'images/users/';
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $jurusan = Jurusan::all(); 
        $jenjang = Jenjang::all(); 

        $verifikasiId = auth()->user()->id;
        $status = auth()->user()->Status;

        $verifikasi = Verifikasi::where('user_id', $verifikasiId)
            ->where('status', 'pending')
            ->exists();
        
        $data = [
            'title' => "Jurusan",
            'jurusan' => $jurusan,
            'jenjang' => $jenjang,
            'status' => $status,
            'user' => $request->user(),
            'verifikasi' => $verifikasi ? true : false
        ];

        return view('profile.edit', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $id = Auth::user()->id;

        $existingVerifikasi = Verifikasi::where('status', 'pending')
             ->whereHas('user', function ($query) use ($id) {
                $query->where('user_id', $id);
        })->exists();

        $existingApproved = Verifikasi::where('status', 'approved')
        ->whereHas('user', function ($query) use ($id) {
           $query->where('user_id', $id);
        })->exists();

        if ($existingVerifikasi) {
            return redirect()->back()->withErrors('Maaf, Anda sudah mengisi informasi. Tinggal menunggu admin melakukan verifikasi.');
        } else if (Auth::user()->Status !== "aktif") {
            $validator = Validator::make($request->all(), [
                'Gambar' => 'required|image|mimes:jpeg,png|max:2048',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
        }

        if ($request->hasFile('Gambar') && $request->file('Gambar')->isValid()) {
            // Create the image name
            $imageName = $request->file('Gambar')->getClientOriginalName();
            $imageName = $id . '-' . time() . '.' . $request->file('Gambar')->extension();
        
            // Move the image to the public folder
            $imagePath = $request->file('Gambar')->storeAs('public/'.$this->path, $imageName);
        
            // Check if the image was not saved
            if (!$imagePath) {
                return redirect()->back()->with('error', 'Gagal menambahkan kampus. Silakan coba lagi.');
            }

            $lokasi_file = $this->path . $imageName;
            // Assign the image path to the 'Gambar' attribute
            $request->user()->Gambar = $lokasi_file;
          
        }

        try {
            DB::beginTransaction();
        
            $pendapatanOrtu = $request->input('PendapatanOrtu');
            $cleanPendapatanOrtu = (int) preg_replace("/[^0-9]/", "", $pendapatanOrtu);
        
            $request->user()->fill($request->validated());
        
            $request->user()->fill([
                'PendapatanOrtu' => $cleanPendapatanOrtu,
            ]);
        
            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
        
            $request->user()->save();
        
            if (Auth::user()->status !== "aktif" && !$existingApproved && auth()->user()->roles->pluck('name')[0] != 'admin') {
                // Membuat pengajuan menjadi status 'pending'
                $verifikasi = new Verifikasi();
                $verifikasi->user_id = Auth::id();
                $verifikasi->status = 'pending';
                $verifikasi->catatan = 'Menunggu persetujuan dari admin';
                $verifikasi->save();
            }
          
        
            DB::commit();
        
            return redirect()->route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            DB::rollBack();
        
            return redirect()->route('profile.edit')->with('status', 'profile-update-failed');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}