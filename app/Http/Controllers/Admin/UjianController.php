<?php

namespace App\Http\Controllers\Admin;

use App\Imports\ImportDataPertanyaan;
use App\Models\pertanyaan;
use App\Models\ujian;
use App\Models\mata_pelajaran;
use App\Models\kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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

        //get relation pertanyaans with pagination
        $exam->setRelation('pertanyaan', $exam->pertanyaan()->paginate(5, ['*'], 'page_pertanyaan'));

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

    /**
     * createpertanyaan
     *
     * @param  mixed $exam
     * @return void
     */
    public function createQuestion(ujian $exam)
    {
        //render with inertia
        return inertia('Admin/Questions/Create', [
            'exam' => $exam,
        ]);
    }
    
    /**
     * storepertanyaan
     *
     * @param  mixed $request
     * @param  mixed $exam
     * @return void
     */
    public function storeQuestion(Request $request, ujian $exam)
{
    //validate request
    $request->validate([
        'pertanyaan' => 'required',
        'pilihan_1' => 'required',
        'pilihan_2' => 'required',
        'pilihan_3' => 'required',
        'pilihan_4' => 'required',
        'pilihan_5' => 'required',
        'jawaban' => 'required',
    ]);

    //create pertanyaan
    pertanyaan::create([
        'id_ujian' => $exam->id_ujian,
        'pertanyaan' => $request->pertanyaan,
        'pilihan_1' => $request->pilihan_1,
        'pilihan_2' => $request->pilihan_2,
        'pilihan_3' => $request->pilihan_3,
        'pilihan_4' => $request->pilihan_4,
        'pilihan_5' => $request->pilihan_5,
        'jawaban' => $request->jawaban,
    ]);

    //redirect
    return redirect()->route('admin.exams.show', $exam->id_ujian);
}
    /**
     * editQuestion
     *
     * @param  mixed $exam
     * @param  mixed $question
     * @return void
     */
    public function editQuestion(ujian $exam, pertanyaan $question)
    {
        //render with inertia
        return inertia('Admin/Questions/Edit', [
            'exam' => $exam,
            'question' => $question,
        ]);
    }

    /**
     * updateQuestion
     *
     * @param  mixed $request
     * @param  mixed $exam
     * @param  mixed $question
     * @return void
     */
    public function updateQuestion(Request $request, ujian $exam, pertanyaan $question)
    {
        //validate request
        $request->validate([
            'pertanyaan'          => 'required',
            'pilihan_1'          => 'required',
            'pilihan_2'          => 'required',
            'pilihan_3'          => 'required',
            'pilihan_4'          => 'required',
            'pilihan_5'          => 'required',
            'jawaban'            => 'required',
        ]);
        
        //update question
        $question->update([
            'pertanyaan'          => $request->pertanyaan,
            'pilihan_1'          => $request->pilihan_1,
            'pilihan_2'          => $request->pilihan_2,
            'pilihan_3'          => $request->pilihan_3,
            'pilihan_4'          => $request->pilihan_4,
            'pilihan_5'          => $request->pilihan_5,
            'jawaban'            => $request->jawaban,
        ]);
        
        //redirect
        return redirect()->route('admin.exams.show', $exam->id_ujian);
    }
    /**
     * destroyQuestion
     *
     * @param  mixed $exam
     * @param  mixed $question
     * @return void
     */
    public function destroyQuestion(ujian $exam, pertanyaan $question)
    {
        //delete question
        $question->delete();
        
        //redirect
        return redirect()->route('admin.exams.show', $exam->id_ujian);
    }

    /**
     * import
     *
     * @return void
     */
    public function import(ujian $exam)
    {
        return inertia('Admin/Questions/Import', [
            'exam' => $exam
        ]);
    }
    
    /**
     * storeImport
     *
     * @param  mixed $request
     * @return void
     */
    public function storeImport(Request $request, ujian $exam)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new ImportDataPertanyaan(), $request->file('file'));

        //redirect
        return redirect()->route('admin.exams.show', $exam->id_ujian);
    }
}

