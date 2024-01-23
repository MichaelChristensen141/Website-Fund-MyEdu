<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Beasiswa;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index(){

        $userCount = User::count();
        $beasiswaCount = Beasiswa::count();
        $verifikasi = Verifikasi::orderBy('id', 'desc')->limit(6)->get();
        $userCountAktif = User::where('Status', 'aktif')->count();
        $pendingUserCount = Verifikasi::where('status', 'pending')->count();

        $data = [
            'title' => "Dashboard",
            'userCount' => $userCount,
            'beasiswaCount' => $beasiswaCount,
            'userCountAktif' => $userCountAktif,
            'verifikasi' => $verifikasi,
            'pendingUserCount' =>  $pendingUserCount,
        ];
        
        return view('dashboard.index',$data);
    
    }
}
