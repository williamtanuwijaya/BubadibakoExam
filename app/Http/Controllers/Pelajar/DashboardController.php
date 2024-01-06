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
         ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
         ->get();

     //define variable array
     $data = [];

     //get nilai
     foreach($kelompok_ujians as $kelompok_ujian) {
         
         //get data nilai / nilai
         $nilai = nilai::where('id_ujian', $kelompok_ujian->id_ujian)
             ->where('id_sesi_ujian', $kelompok_ujian->id_sesi_ujian)
             ->where('id_pelajar', auth()->guard('pelajar')->user()->id_pelajar)
             ->first();

         //jika nilai / nilai kosong, maka buat baru
         if($nilai == null) {

             //create defaul nilai
             $nilai = new nilai();
             $nilai->id_ujian         = $kelompok_ujian->id_ujian;
             $nilai->id_sesi_ujian = $kelompok_ujian->id_sesi_ujian;
             $nilai->id_pelajar      = auth()->guard('pelajar')->user()->id_pelajar;
             $nilai->duration        = $kelompok_ujian->exam->durasi * 60000;
             $nilai->total_correct   = 0;
             $nilai->nilai           = 0;
             $nilai->save();

         }

         $data[] = [
             'kelompok_ujian' => $kelompok_ujian,
             'nilai'      => $nilai
         ];

     }

     //return with inertia
     return inertia('Pelajar/Dashboard/Index', [
         'kelompok_ujians' => $data,
     ]);
    }
}
