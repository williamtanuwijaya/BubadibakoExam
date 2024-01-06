<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\jawaban;
use App\Models\kelompok_ujian;
use App\Models\nilai;
use App\Models\pertanyaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function confirmation($id)
    {
        //get kelompok ujian
        $kelompok_ujian = kelompok_ujian::with('ujian.mata_pelajaran', 'sesi_ujian', 'pelajar.kelas')
                    ->where('id_pelajar', auth()->guard('student')->user()->id_pelajar)
                    ->where('id', $id)
                    ->first();

        //get nilai / nilai
        $nilai = nilai::where('id_ujian', $kelompok_ujian->ujian->id_ujian)
                    ->where('id_sesi_ujian', $kelompok_ujian->sesi_ujian->id_sesi_ujian)
                    ->where('id_pelajar', auth()->guard('pelajar')->user()->id_pelajar)
                    ->first();
        
        //return with inertia
        return inertia('Student/Exams/Confirmation', [
            'kelompok_ujian' => $kelompok_ujian,
            'nilai' => $nilai,
        ]);
    }


     /**
     * startExam
     *
     * @param  mixed $id
     * @return void
     */
    public function startExam($id)
    {
        //get ujian group
        $kelompok_ujian = kelompok_ujian::with('ujian.mata_pelajaran', 'sesi_ujian', 'pelajar.kelas')
                    ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                    ->where('id', $id)
                    ->first();

        //get grade / nilai
        $grade = nilai::where('id_ujian', $kelompok_ujian->ujian->id)
                    ->where('id_sesi_ujian', $kelompok_ujian->sesi_ujian->id)
                    ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                    ->first();

        //update start time di table grades
        $grade->start_time = Carbon::now();
        $grade->update();

        //cek apakah pertanyaans / soal ujian di random
        if($kelompok_ujian->ujian->random_pertanyaan == 'Y') {

            //get pertanyaans / soal ujian
            $pertanyaans = pertanyaan::where('id_ujian', $kelompok_ujian->ujian->id_ujian)->inRandomOrder()->get();

        } else {

            //get pertanyaans / soal ujian
            $pertanyaans = pertanyaan::where('id_ujian', $kelompok_ujian->ujian->id_ujian)->get();

        }

        //define pilihan jawaban default
        $urutan_pertanyaan = 1;

        foreach ($pertanyaans as $pertanyaan) {

            //buat array jawaban / answer
            $pilihans = [1,2];
            if(!empty($pertanyaan->pilihan_3)) $pilihans[] = 3;
            if(!empty($pertanyaan->pilihan_4)) $pilihans[] = 4;
            if(!empty($pertanyaan->pilihan_5)) $pilihans[] = 5;

            //acak jawaban / answer
            if($kelompok_ujian->ujian->random_answer == 'Y') {
                shuffle($pilihans);
            }

            //cek apakah sudah ada data jawaban
            $answer = jawaban::where('id_pelajar', auth()->guard('pelajar')->user()->id)
                    ->where('id_ujian', $kelompok_ujian->ujian->id_ujian)
                    ->where('id_sesi_ujian', $kelompok_ujian->sesi_ujian->id_sesi_ujian)
                    ->where('id_pertanyaan', $pertanyaan->id_pertanyaan)
                    ->first();

            //jika sudah ada jawaban / answer
            if($answer) {

                //update urutan pertanyaan / soal
                $answer->urutan_pertanyaan = $urutan_pertanyaan;
                $answer->update();

            } else {

                //buat jawaban default baru
                jawaban::create([
                    'id_ujian'           => $kelompok_ujian->ujian->id_ujian,
                    'id_sesi_ujian'   => $kelompok_ujian->sesi_ujian->id_sesi_ujian,
                    'id_pertanyaan'       => $pertanyaan->id_pertanyaan,
                    'id_pelajar'        => auth()->guard('pelajar')->user()->id,
                    'urutan_pertanyaan'    => $urutan_pertanyaan,
                    'urutan_jawaban'      => implode(",", $pilihans),
                    'jawwaban'            => 0,
                    'is_correct'        => 'N'
                ]);

            }
            $urutan_pertanyaan++;

        }

        //redirect ke ujian halaman 1
        return redirect()->route('pelajar.ujians.show', [
            'id'    => $kelompok_ujian->id, 
            'page'  => 1
        ]);   
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @param  mixed $page
     * @return void
     */
    public function show($id, $page)
    {
        //get ujian group
        $kelompok_ujian = kelompok_ujian::with('ujian.lesson', 'sesi_ujian', 'pelajar.classroom')
                    ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                    ->where('id', $id)
                    ->first();

        if(!$kelompok_ujian) {
            return redirect()->route('pelajar.dashboard');
        }

        //get all pertanyaans
        $all_pertanyaans = jawaban::with('pertanyaan')
                        ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                        ->where('id_ujian', $kelompok_ujian->ujian->id_ujian)
                        ->orderBy('urutan_pertanyaan', 'ASC')
                        ->get();

        //count all pertanyaan answered
        $pertanyaan_answered = jawaban::with('pertanyaan')
                        ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                        ->where('id_ujian', $kelompok_ujian->ujian->id_ujian)
                        ->where('answer', '!=', 0)
                        ->count();


        //get pertanyaan active
        $pertanyaan_active = jawaban::with('pertanyaan.ujian')
                        ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                        ->where('id_ujian', $kelompok_ujian->ujian->id_ujian)
                        ->where('urutan_pertanyaan', $page)
                        ->first();
        
        //explode atau pecah jawaban
        if ($pertanyaan_active) {
            $urutan_pertanyaan = explode(",", $pertanyaan_active->urutan_pertanyaan);
        } else  {
            $urutan_pertanyaan = [];
        }

        //get durasi
        $durasi = nilai::where('id_ujian', $kelompok_ujian->ujian->id_ujian)
                    ->where('id_sesi_ujian', $kelompok_ujian->sesi_ujian->id_sesi_ujian)
                    ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                    ->first();

        //return with inertia
        return inertia('Student/Exams/Show', [
            'id'                => (int) $id,
            'page'              => (int) $page,
            'kelompok_ujian'        => $kelompok_ujian,
            'all_pertanyaans'     => $all_pertanyaans,
            'pertanyaan_answered' => $pertanyaan_answered,
            'pertanyaan_active'   => $pertanyaan_active,
            'urutan_pertanyaan' => $urutan_pertanyaan,
            'durasi'        	=> $durasi,
        ]); 
    }

      /**
     * updateDuration
     *
     * @param  mixed $request
     * @param  mixed $grade_id
     * @return void
     */
    public function updateDuration(Request $request, $id_nilai)
    {
        $nilai = nilai::find($id_nilai);
        $nilai->durasi = $request->durasi;
        $nilai->update();

        return response()->json([
            'success'  => true,
            'message' => 'Duration updated successfully.'
        ]);
    }

     /**
     * jawabanQuestion
     *
     * @param  mixed $request
     * @return void
     */
    public function jawabanQuestion(Request $request)
    {
        //update duration
        $nilai = nilai::where('id_ujian', $request->id_ujian)
                ->where('id_sesi_ujian', $request->id_sesi_ujian)
                ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                ->first();

        $nilai->duration = $request->duration;
        $nilai->update();

        //get question
        $question = pertanyaan::find($request->id_pertanyaan);
        
        //cek apakah jawaban sudah benar
        if($question->jawaban == $request->jawaban) {

            //jawaban benar
            $result = 'Y';
        } else {

            //jawaban salah
            $result = 'N';
        }

        //get jawaban
        $jawaban   = jawaban::where('id_ujian', $request->id_ujian)
                    ->where('id_sesi_ujian', $request->id_sesi_ujian)
                    ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                    ->where('id_pertanyaan', $request->id_pertanyaan)
                    ->first();

        //update jawaban
        if($jawaban) {
            $jawaban->jawaban     = $request->jawaban;
            $jawaban->is_correct = $result;
            $jawaban->update();
        }

        return redirect()->back();
    }

    /**
     * endExam
     *
     * @param  mixed $request
     * @return void
     */
    public function endExam(Request $request)
    {
        //count jawaban benar
        $count_correct_jawaban = jawaban::where('id_ujian', $request->id_ujian)
                            ->where('id_sesi_ujian', $request->id_sesi_ujian)
                            ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                            ->where('is_correct', 'Y')
                            ->count();

        //count jumlah soal
        $count_question = pertanyaan::where('id_ujian', $request->id_ujian)->count();

        //hitung nilai
        $nilai_ujian = round($count_correct_jawaban/$count_question*100, 2);

        //update nilai di table nilais
        $nilai = nilai::where('id_ujian', $request->id_ujian)
                ->where('id_sesi_ujian', $request->id_sesi_ujian)
                ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                ->first();
        
        $nilai->end_time        = Carbon::now();
        $nilai->total_correct   = $count_correct_jawaban;
        $nilai->nilai           = $nilai_ujian;
        $nilai->update();

        //redirect hasil
        return redirect()->route('pelajar.ujians.resultExam', $request->kelompok_ujian_id);
    }

    /**
     * resultExam
     *
     * @param  mixed $id
     * @return void
     */
    public function resultExam($id_kelompok_ujian)
    {
        //get ujian group
        $kelompok_ujian = kelompok_ujian::with('ujian.lesson', 'sesi_ujian', 'pelajar.classroom')
                ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                ->where('id', $id_kelompok_ujian)
                ->first();

        //get nilai / nilai
        $nilai = nilai::where('id_ujian', $kelompok_ujian->ujian->id)
                ->where('id_sesi_ujian', $kelompok_ujian->sesi_ujian->id)
                ->where('id_pelajar', auth()->guard('pelajar')->user()->id)
                ->first();

        //return with inertia
        return inertia('Student/Exams/Result', [
            'kelompok_ujian' => $kelompok_ujian,
            'nilai'      => $nilai,
        ]);
    }
}

