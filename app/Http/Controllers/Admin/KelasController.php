<?php

namespace App\Http\Controllers\Admin;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get kelass
        $kelass = kelas::when(request()->q, function($kelass) {
            $kelass = $kelass->where('nama_kelas', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $kelass->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Kelas/Index', [
            'kelass' => $kelass,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //render with inertia
        return inertia('Admin/Kelas/Create');
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
            'nama_kelas' => 'required|string|unique:kelas'
        ]);

        //create kelas
        kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        //redirect
        return redirect()->route('admin.kelas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kelas)
    {
        //get kelas
        $kelas = kelas::findOrFail($id_kelas);

        //render with inertia
        return inertia('Admin/Kelas/Edit', [
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas $kelas)
    {
        //validate request
        $request->validate([
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas,'.$kelas->id_kelas.',id_kelas',
        ]);

        //update kelas
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        //redirect
        return redirect()->route('admin.kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kelas)
    {
        //get kelas
        $kelas = kelas::findOrFail($id_kelas);

        //delete kelas
        $kelas->delete();

        //redirect
        return redirect()->route('admin.kelas.index');
    }
}