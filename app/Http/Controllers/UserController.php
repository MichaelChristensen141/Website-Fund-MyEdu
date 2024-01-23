<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(10); // Menggunakan paginasi dengan 10 item per halaman
        $data = [
            'title' => "Kelola Users",
            'users' => $users
        ];
        return view('user.index', $data);
    }


    public function verifikasi()
    {
         // Menggunakan paginasi dengan 10 item per halaman
        $verifikasi = Verifikasi::where('status', 'pending')->orderBy('id', 'DESC')->paginate(10);

        $data = [
            'title' => "Verifikasi Users",
            'verifikasi' => $verifikasi
        ];
        return view('user.verifikasi', $data);
    }

    public function storeVerifikasi(Request $request, $id)
    {
        $verifikasi = Verifikasi::where('user_id', $id)
        ->where('status', 'pending')
        ->first();

        if ($verifikasi) {
            try{
                DB::beginTransaction();
                $verifikasi->delete();
                Verifikasi::create([
                'user_id' => $id,
                'status' => 'approved',
                'catatan' => 'Verifikasi berhasil',
                ]);

                User::where('id', $id)->update(['status' => 'aktif']);

                DB::commit();
                return redirect()->back()->with('success', 'Verifikasi berhasil disimpan');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan verifikasi');
            }
        }else{
            return redirect()->back()->withErrors('Verifikasi tidak ditemukan');
        }
    }

    public function rejectVerifikasi(Request $request, $id)
    {
        $verifikasi = Verifikasi::where('user_id', $id)
        ->where('status', 'pending')
        ->first();

        if ($verifikasi) {
            try{
                DB::beginTransaction();
                $verifikasi->delete();
                Verifikasi::create([
                'user_id' => $id,
                'status' => 'rejected',
                'catatan' => 'Verifikasi ditolak',
                ]);

               
                
                DB::commit();
                return redirect()->back()->with('success', 'Verifikasi berhasil disimpan');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan verifikasi');
            }
        }else{
            return redirect()->back()->withErrors('Verifikasi tidak ditemukan');
        }
    }
}