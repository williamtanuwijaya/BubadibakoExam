<?php

namespace App\Http\Controllers\Admin;

use App\Models\ujian;
use App\Models\pelajar;
use App\Models\kelas;
use App\Models\sesi_ujian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //count students
        $students = pelajar::count();

        //count exams
        $exams = ujian::count();

        //count exam sessions
        $exam_sessions = sesi_ujian::count();

        //count classrooms
        $classrooms = kelas::count();

        // Log data for debugging
//        \Log::info("Dashboard Data: ", compact('students', 'exams', 'exam_sessions', 'classrooms'));

        return inertia('Admin/Dashboard/Index', [
            'students'      => $students,
            'exams'         => $exams,
            'exam_sessions' => $exam_sessions,
            'classrooms'    => $classrooms,
        ]);
    }
}
