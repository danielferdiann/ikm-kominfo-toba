<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responden;

class SurveiController extends Controller
{
    public function index() { return view('survei'); }

    public function simpan(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'layanan' => 'required',
            'u1' => 'required|integer',
            'u2' => 'required|integer',
            'u3' => 'required|integer',
            'u4' => 'required|integer',
            'u5' => 'required|integer',
        ]);

        Responden::create($validatedData);
        return redirect('/terimakasih');
    }

    public function dashboard()
    {
        $semua_responden = Responden::orderBy('created_at', 'desc')->get();
        $total_responden = $semua_responden->count();

        // Hitung IKM dengan pembagi 5
        $total_skor_semua = Responden::selectRaw('SUM(u1+u2+u3+u4+u5) as total')->first()->total;
        $ikm_final = $total_responden > 0 ? ($total_skor_semua / (5 * $total_responden)) * 25 : 0;

        $skor_layanan = [];
        $jumlah_responden_per_layanan = [];
        $layanan_list = ['PPID', 'Infrastruktur', 'E-Gov'];

        foreach ($layanan_list as $lay) {
            $data = Responden::where('layanan', $lay)->get();
            $count = $data->count();
            if ($count > 0) {
                $sum = $data->sum(function($r) {
                    return ($r->u1 + $r->u2 + $r->u3 + $r->u4 + $r->u5) / 5 * 25;
                });
                $skor_layanan[] = round($sum / $count, 2);
                $jumlah_responden_per_layanan[] = $count;
            } else {
                $skor_layanan[] = 0;
                $jumlah_responden_per_layanan[] = 0;
            }
        }

        return view('dashboard', compact('semua_responden', 'total_responden', 'ikm_final', 'skor_layanan', 'jumlah_responden_per_layanan'));
    }

    public function hapus($id)
    {
        Responden::destroy($id);
        return redirect()->back();
    }
}