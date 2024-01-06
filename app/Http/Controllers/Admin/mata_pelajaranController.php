<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class mata_pelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get lessons
        $lessons = Lesson::when(request()->q, function($lessons) {
            $lessons = $lessons->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $lessons->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/mata_pelajaran/Index', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/mata_pelajaran/Create');
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
            'title' => 'required|string|unique:lessons',
        ]);

        //create lesson
        Lesson::create([
            'title' => $request->title,
        ]);

        //redirect
        return redirect()->route('admin.lessons.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get lesson
        $lesson = Lesson::findOrFail($id);

        //render with inertia
        return inertia('Admin/mata_pelajaran/Edit', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //validate request
        $request->validate([
            'title' => 'required|string|unique:lessons,title,'.$lesson->id,
        ]);

        //update lesson
        $lesson->update([
            'title' => $request->title,
        ]);

        //redirect
        return redirect()->route('admin.lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get lesson
        $lesson = Lesson::findOrFail($id);

        //delete lesson
        $lesson->delete();

        //redirect
        return redirect()->route('admin.lessons.index');
    }
}
