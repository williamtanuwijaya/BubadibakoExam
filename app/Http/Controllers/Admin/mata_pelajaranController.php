<?php

namespace App\Http\Controllers\Admin;

use App\Models\mata_pelajaran;
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
        //get mata_pelajarans
        $mata_pelajarans = mata_pelajaran::when(request()->q, function($mata_pelajarans) {
            $mata_pelajarans = $mata_pelajarans->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $mata_pelajarans->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/mata_pelajaran/Index', [
            'mata_pelajarans' => $mata_pelajarans,
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
            'title' => 'required|string|unique:mata_pelajarans',
        ]);

        //create mata_pelajaran
        mata_pelajaran::create([
            'title' => $request->title,
        ]);

        //redirect
        return redirect()->route('admin.mata_pelajaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get mata_pelajaran
        $mata_pelajaran = mata_pelajaran::findOrFail($id);

        //render with inertia
        return inertia('Admin/mata_palajaran/Edit', [
            'mata_pelajaran' => $mata_pelajaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mata_pelajaran $mata_pelajaran)
    {
        //validate request
        $request->validate([
            'title' => 'required|string|unique:mata_pelajarans,title,'.$mata_pelajaran->id,
        ]);

        //update mata_pelajaran
        $mata_pelajaran->update([
            'title' => $request->title,
        ]);

        //redirect
        return redirect()->route('admin.mata_pelajarans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get mata_pelajaran
        $mata_pelajaran = mata_pelajaran::findOrFail($id);

        //delete mata_pelajaran
        $mata_pelajaran->delete();

        //redirect
        return redirect()->route('admin.mata_pelajarans.index');
    }
}