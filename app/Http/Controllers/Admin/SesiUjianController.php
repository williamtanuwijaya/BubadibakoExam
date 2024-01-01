<?php

namespace App\Http\Controllers\Admin;

use App\Models\kelompok_ujian;
use App\Models\pelajar;
use App\Models\ujian;
use App\Models\sesi_ujian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SesiUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get exam_sessions
        $exam_sessions = sesi_ujian::with('ujian.kelas', 'ujian.mata_pelajaran', 'kelompok_ujian')->latest()->paginate(5);

        //append query string to pagination links
        $exam_sessions->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/ExamSessions/Index', [
            'exam_sessions' => $exam_sessions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get exams
        $exams = ujian::all();

        //render with inertia
        return inertia('Admin/ExamSessions/Create', [
            'exams' => $exams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'sesi_ujian' => 'required',
            'id_ujian' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        //create exam_session
        sesi_ujian::create([
            'sesi_ujian' => $request->sesi_ujian,
            'id_ujian' => $request->id_ujian,
            'waktu_mulai' => date('Y-m-d H:i:s', strtotime($request->waktu_mulai)),
            'waktu_selesai' => date('Y-m-d H:i:s', strtotime($request->waktu_selesai)),
        ]);

        //redirect
        return redirect()->route('admin.exam_sessions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id_sesi_ujian
     * @return \Illuminate\Http\Response
     */
    public function show($id_sesi_ujian)
    {
        //get exam_session
        $exam_session = sesi_ujian::with('ujian.kelas', 'ujian.mata_pelajaran')->findOrFail($id_sesi_ujian);

        //get relation exam_groups with pagination
        $exam_session->setRelation('kelompok_ujians', $exam_session->kelompok_ujian()->with('pelajar.classrooms')->paginate(5));

        //render with inertia
        return inertia('Admin/ExamSessions/Show', [
            'exam_session' => $exam_session,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id_sesi_ujian
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sesi_ujian)
    {
        //get exam_session
        $exam_session = sesi_ujian::findOrFail($id_sesi_ujian);

        //get exams
        $exams = ujian::all();

        //render with inertia
        return inertia('Admin/ExamSessions/Edit', [
            'exam_session' => $exam_session,
            'exams' => $exams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id_sesi_ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sesi_ujian $exam_session)
    {
        //validate request
        $request->validate([
            'sesi_ujian' => 'required',
            'id_ujian' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ]);

        //update exam_session
        $exam_session->update([
            'sesi_ujian' => $request->sesi_ujian,
            'id_ujian' => $request->id_ujian,
            'waktu_mulai' => date('Y-m-d H:i:s', strtotime($request->waktu_mulai)),
            'waktu_selesai' => date('Y-m-d H:i:s', strtotime($request->waktu_selesai)),
        ]);

        //redirect
        return redirect()->route('admin.exam_sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id_sesi_ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sesi_ujian)
    {
        //get exam_session
        $exam_session = sesi_ujian::findOrFail($id_sesi_ujian);

        //delete exam_session
        $exam_session->delete();

        //redirect
        return redirect()->route('admin.exam_sessions.index');
    }

    /**
     * createEnrolle
     *
     * @param mixed $exam_session
     * @return void
     */
    public function createEnrolle(sesi_ujian $exam_session)
    {
        //get exams
        $exam = $exam_session->ujian;

        //get students already enrolled
        $students_enrolled = kelompok_ujian::where('id_ujian', $exam->id_sesi_ujian)->where('id_sesi_ujian', $exam_session->id_ujian)->pluck('id_pelajar')->all();
//        $students_enrolled = kelompok_ujian::where('id_ujian', $exam->id_sesi_ujian)
//            ->where('id_sesi_ujian', $exam_session->id_ujian)
//            ->pluck('id_pelajar')
//            ->toArray();

        $students = pelajar::with('kelas')->get();
//        $students_enrolled = kelompok_ujian::where('id_ujian', $exam->id_sesi_ujian)->where('id_sesi_ujian', $exam_session->id_ujian)->pluck('id_pelajar')->toArray();
        //get students
//        $students = pelajar::with('kelas')->where('id_kelas', $exam->id_pelajar)->whereNotIn('id_pelajar', $students_enrolled)->get();
//        dd($students->toArray());



        //render with inertia
        return inertia('Admin/ExamGroups/Create', [
            'exam' => $exam,
            'exam_session' => $exam_session,
            'students' => $students,
        ]);
    }

    /**
     * storeEnrolle
     *
     * @param mixed $exam_session
     * @return void
     */
    public function storeEnrolle(Request $request, sesi_ujian $exam_session)
    {
        //validate request
        $request->validate([
            'id_pelajar' => 'required',
        ]);

        //create exam_group
        foreach ($request->id_pelajar as $id_pelajar) {

            //select student
            $student = pelajar::findOrFail($id_pelajar);

            //create exam_group
            kelompok_ujian::create([
                'id_ujian' => $request->id_ujian,
                'id_sesi_ujian' => $exam_session->id_sesi_ujian,
                'id_pelajar' => $student->id_pelajar,
            ]);
        }

        //redirect
        return redirect()->route('admin.exam_sessions.show', $exam_session->id_sesi_ujian);
    }
}
