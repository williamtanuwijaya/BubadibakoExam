<?php

namespace App\Http\Controllers\Admin;

use App\Models\ujian;
use App\Models\mata_pelajaran;
use App\Models\kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get exams
        $exams = ujian::when(request()->q, function($exams) {
            $exams = $exams->where('nama_ujian', 'like', '%'. request()->q . '%');
        })->with('mata_pelajaran', 'kelas', 'pertanyaan')->latest()->paginate(5);

        //append query string to pagination links
        $exams->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Exams/Index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get lessons
        $lessons = mata_pelajaran::all();

        //get classrooms
        $classrooms = kelas::all();

        //render with inertia
        return inertia('Admin/Exams/Create', [
            'lessons' => $lessons,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'nama_ujian' => 'required',
            'id_mapel' => 'required|integer',
            'id_kelas' => 'required|integer',
            'durasi' => 'required|integer',
            'deskripsi' => 'required',
            'pertanyaan_acak' => 'required',
            'jawaban_acak' => 'required',
            'hasil' => 'required',
        ]);

        //create exam
        ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'durasi' => $request->durasi,
            'deskripsi' => $request->deskripsi,
            'pertanyaan_acak' => $request->pertanyaan_acak,
            'jawaban_acak' => $request->jawaban_acak,
            'hasil' => $request->hasil,
        ]);

        //redirect
        return redirect()->route('admin.exams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_ujian
     * @return \Illuminate\Http\Response
     */
    public function show($id_ujian)
    {
        //get exam
        $exam = ujian::with('mata_pelajaran', 'kelas')->findOrFail($id_ujian);

        //get relation questions with pagination
        $exam->setRelation('pertanyaan', $exam->pertanyaan()->paginate(5));

        //render with inertia
        return inertia('Admin/Exams/Show', [
            'exam' => $exam,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_ujian
     * @return \Illuminate\Http\Response
     */
    public function edit($id_ujian)
    {
        //get exam
        $exam = ujian::findOrFail($id_ujian);

        //get lessons
        $lessons = mata_pelajaran::all();

        //get classrooms
        $classrooms = kelas::all();

        //render with inertia
        return inertia('Admin/Exams/Edit', [
            'exam' => $exam,
            'lessons' => $lessons,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ujian $exam)
    {
        //validate request
        $request->validate([
            'nama_ujian' => 'required',
            'id_mapel' => 'required|integer',
            'id_kelas' => 'required|integer',
            'durasi' => 'required|integer',
            'deskripsi' => 'required',
            'pertanyaan_acak' => 'required',
            'jawaban_acak' => 'required',
            'hasil' => 'required',
        ]);

        //update exam
        $exam->update([
            'nama_ujian' => $request->nama_ujian,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'durasi' => $request->durasi,
            'deskripsi' => $request->deskripsi,
            'pertanyaan_acak' => $request->pertanyaan_acak,
            'jawaban_acak' => $request->jawaban_acak,
            'hasil' => $request->hasil,
        ]);

        //redirect
        return redirect()->route('admin.exams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_ujian)
    {
        //get exam
        $exam = ujian::findOrFail($id_ujian);

        //delete exam
        $exam->delete();

        //redirect
        return redirect()->route('admin.exams.index');
    }
}
