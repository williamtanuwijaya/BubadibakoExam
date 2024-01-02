<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NilaiExport;
use App\Models\ujian;
use App\Models\nilai;
use App\Models\sesi_ujian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //geta ll exams
        $exams = ujian::with('mata_pelajaran', 'kelas')->get();

        return inertia('Admin/Reports/Index', [
            'exams' => $exams,
            'grades' => []
        ]);
    }

    /**
     * filter
     *
     * @param mixed $request
     * @return void
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'id_ujian' => 'required',
        ]);

        //geta ll exams
        $exams = ujian::with('mata_pelajaran', 'kelas')->get();

        //get exam
        $exam = Exam::with('lesson', 'classroom')
            ->where('id', $request->exam_id)
            ->first();

        if ($exam) {

            //get exam session
            $exam_session = sesi_ujian::where('id_ujian', $exam->id_sesi_ujian)->first();

            //get grades / nilai
            $grades = nilai::with('pelajar', 'ujian.kelas', 'ujian.mata_pelajaran', 'sesi_ujian')
                ->where('id_ujian', $exam->id_ujian)
                ->where('id_sesi_ujian', $exam_session->id_sesi_ujian)
                ->get();

        } else {
            $grades = [];
        }

        return inertia('Admin/Reports/Index', [
            'exams' => $exams,
            'grades' => $grades,
        ]);
    }

    /**
     * export
     *
     * @param mixed $request
     * @return void
     */
    public function export(Request $request)
    {
        //get exam
        $exam = ujian::with('mata_pelajaran', 'kelas')
            ->where('id_ujian', $request->id_ujian)
            ->first();

        //get exam session
        $exam_session = sesi_ujian::where('id_ujian', $exam->id_ujian)->first();

        //get grades / nilai
        $grades = nilai::with('pelajar', 'ujian.kelas', 'ujian.mata_pelajaran', 'sesi_ujian')
            ->where('id_ujian', $exam->id_ujian)
            ->where('id_sesi_ujian', $exam_session->id_sesi_ujian)
            ->get();

        return Excel::download(new NilaiExport($grades), 'grade : ' . $exam->nama_ujian . ' — ' . $exam->mata_pelajaran->nama_mapel . ' — ' . Carbon::now() . '.xlsx');
    }
}
