<?php

namespace App\Http\Controllers\Pelajar;

use App\Models\kelompok_ujian;
use App\Models\ujian;
use App\Models\pelajar;
use App\Models\kelas;
use App\Models\sesi_ujian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\nilai;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
         //get exam groups
         $kelompok_ujians = kelompok_ujian::with('ujian.mata_pelajaran', 'sesi_ujian', 'pelajar.kelas')
         ->where('id_pelajar', auth()->guard('pelajar')->user()->id_pelajar)
         ->get();

     //define variable array
     $data = [];
//     $nilai = null;

     //get nilai
//        dd($kelompok_ujians);
     foreach($kelompok_ujians as $kelompok_ujian) {
//         dd('Check 1');
         //get data nilai / nilai
         $nilai = nilai::where('id_ujian', $kelompok_ujian->id_ujian)
             ->where('id_sesi_ujian', $kelompok_ujian->id_sesi_ujian)
             ->where('id_pelajar', auth()->guard('pelajar')->user()->id_pelajar)
             ->first();
//         dd('Check 2', $nilai);
//         dd($kelompok_ujian->id_ujian, $kelompok_ujian->id_sesi_ujian, auth()->guard('pelajar')->user()->id_pelajar);

         //jika nilai / nilai kosong, maka buat baru
         if($nilai == null) {
//             dd('Check 3');
             //create defaul nilai
             $nilai = new nilai();
             $nilai->id_ujian         = $kelompok_ujian->id_ujian;
             $nilai->id_sesi_ujian = $kelompok_ujian->id_sesi_ujian;
             $nilai->id_pelajar      = auth()->guard('pelajar')->user()->id_pelajar;
             $nilai->durasi        = $kelompok_ujian->ujian->durasi * 60000;
             $nilai->total_benar   = 0;
             $nilai->nilai           = 0;
             $nilai->save();
//dd($nilai);
         }


         $data[] = [
             'kelompok_ujian' => $kelompok_ujian,
             'nilai'      => $nilai
         ];

     }
//        dd($nilai);
//        dd('Check 4', $data);
//        dd($data);
     //return with inertia
     return inertia('Pelajar/Dashboard/Index', [
         'kelompok_ujians' => $data,
     ]);
    }
}
