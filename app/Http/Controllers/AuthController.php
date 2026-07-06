<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Responden;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Kita gunakan email sebagai username agar sesuai dengan user yang dibuat di Tinker
        $credentials = [
            'email' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function dashboard()
    {
        $semua_responden = Responden::latest()->get();
        $total_responden = $semua_responden->count();

        // 1. Hitung IKM Final (Sekarang pembagi 5)
        $ikm_final = 0;
        if ($total_responden > 0) {
            $total_nilai = $semua_responden->sum(function($r) {
                // Hanya hitung u1 sampai u5
                return ($r->u1 + $r->u2 + $r->u3 + $r->u4 + $r->u5) / 5;
            });
            $ikm_final = ($total_nilai / $total_responden) * 25;
        }

        // 2. Data untuk Grafik Batang (Skor per Layanan)
        $skor_ppid = Responden::where('layanan', 'PPID')->avg(DB::raw('(u1+u2+u3+u4+u5)/5*25')) ?? 0;
        $skor_infra = Responden::where('layanan', 'Infrastruktur')->avg(DB::raw('(u1+u2+u3+u4+u5)/5*25')) ?? 0;
        $skor_egov = Responden::where('layanan', 'E-Gov')->avg(DB::raw('(u1+u2+u3+u4+u5)/5*25')) ?? 0;
        
        $chart_skor = [$skor_ppid, $skor_infra, $skor_egov];

        // 3. Data untuk Grafik Lingkaran (Jumlah Responden per Layanan)
        $jumlah_ppid = Responden::where('layanan', 'PPID')->count();
        $jumlah_infra = Responden::where('layanan', 'Infrastruktur')->count();
        $jumlah_egov = Responden::where('layanan', 'E-Gov')->count();
        
        $chart_jumlah = [$jumlah_ppid, $jumlah_infra, $jumlah_egov];

        return view('dashboard', compact(
            'semua_responden', 
            'total_responden', 
            'ikm_final', 
            'chart_skor', 
            'chart_jumlah'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function hapusResponden($id) 
    {
        $data = Responden::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Data responden berhasil dihapus!');
    }

    public function exportExcel()
    {
        $data = Responden::all();
        $filename = "Laporan_IKM_DiskominfoToba_" . date('Y-m-d') . ".csv";
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Nama', 'Layanan', 'U1', 'U2', 'U3', 'U4', 'U5', 'Tanggal']);

        foreach ($data as $row) {
            fputcsv($handle, [
                $row->nama, 
                $row->layanan, 
                $row->u1, $row->u2, $row->u3, $row->u4, $row->u5, 
                $row->created_at->format('d M Y H:i')
            ]);
        }

        fclose($handle);
        exit;
    }
}