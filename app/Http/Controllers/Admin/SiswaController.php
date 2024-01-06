<?php

namespace App\Http\Controllers\Admin;

use App\Models\pelajar;
use App\Models\kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ImportDataSiswa;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get students
        $students = pelajar::when(request()->q, function($students) {
            $students = $students->where('nama', 'like', '%'. request()->q . '%');
        })->with('kelas')->latest()->paginate(5);

        //append query string to pagination links
        $students->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Students/Index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get classrooms
        $classrooms = kelas::all();

        //render with inertia
        return inertia('Admin/Students/Create', [
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
            'nama'          => 'required|string|max:255',
            'nisn'          => 'required|unique:pelajars',
            'jenis_kelamin'        => 'required|string',
            'kata_sandi'      => 'required|confirmed',
            'id_kelas'  => 'required'
        ]);

        //create student
        pelajar::create([
            'nama'          => $request->nama,
            'nisn'          => $request->nisn,
            'jenis_kelamin'        => $request->jenis_kelamin,
            'kata_sandi'      => $request->kata_sandi,
            'id_kelas'  => $request->id_kelas
        ]);

        //redirect
        return redirect()->route('admin.students.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_pelajar
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pelajar)
    {
        //get student
        $student = pelajar::findOrFail($id_pelajar);

        //get classrooms
        $classrooms = kelas::all();

        //render with inertia
        return inertia('Admin/Students/Edit', [
            'student' => $student,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_pelajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pelajar $student)
    {
        //validate request
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nisn' => 'required|unique:pelajars,nisn,' . $student->id_pelajar . ',id_pelajar',
            'jenis_kelamin'        => 'required|string',
            'id_kelas'  => 'required',
            'kata_sandi'      => 'confirmed'
        ]);

        //check passwordy
        if($request->kata_sandi == "") {

            //update student without password
            $student->update([
                'nama'          => $request->nama,
                'nisn'          => $request->nisn,
                'jenis_kelamin'        => $request->jenis_kelamin,
                'id_kelas'  => $request->id_kelas
            ]);

        } else {

            //update student with password
            $student->update([
                'nama'          => $request->nama,
                'nisn'          => $request->nisn,
                'jenis_kelamin'        => $request->jenis_kelamin,
                'kata_sandi'      => $request->kata_sandi,
                'id_kelas'  => $request->id_kelas
            ]);

        }

        //redirect
        return redirect()->route('admin.students.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_pelajar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pelajar)
    {
        //get student
        $student = pelajar::findOrFail($id_pelajar);

        //delete student
        $student->delete();

        //redirect
        return redirect()->route('admin.students.index');
    }

    /**
     * import
     *
     * @return void
     */
    public function import()
    {
        return inertia('Admin/Students/Import');
    }

    /**
     * storeImport
     *
     * @param  mixed $request
     * @return void
     */
    public function storeImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new ImportDataSiswa(), $request->file('file'));

        //redirect
        return redirect()->route('admin.students.index');

    }
}
