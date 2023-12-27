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
        // Get mata_pelajarans
        $mata_pelajarans = mata_pelajaran::when(request()->q, function ($query) {
            $query->where('nama_mapel', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        // Append query string to pagination links
        $mata_pelajarans->appends(['q' => request()->q]);

        // Render with inertia
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'nama_mapel' => 'required|string|unique:mata_pelajarans',
        ]);

        // Create mata_pelajaran
        mata_pelajaran::create([
            'nama_mapel' => $request->nama_mapel,
        ]);

        // Redirect
        return redirect()->route('admin.mata_pelajaran.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id_mapel
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mapel)
    {
        // Get mata_pelajaran
        $mata_pelajaran = mata_pelajaran::findOrFail($id_mapel);

        // Render with inertia
        return inertia('Admin/mata_pelajaran/Edit', [
            'mata_pelajaran' => $mata_pelajaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id_mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mata_pelajaran $mata_pelajaran)
    {
        // Validate request
        $request->validate([
            'nama_mapel' => 'required|string|unique:mata_pelajarans,nama_mapel,' . $mata_pelajaran->id_mapel.',id_mapel',
        ]);

        // Update mata_pelajaran
        $mata_pelajaran->update([
            'nama_mapel' => $request->nama_mapel,
        ]);

        // Redirect
        return redirect()->route('admin.mata_pelajaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id_mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_mapel)
    {
        // Get mata_pelajaran
        $mata_pelajaran = mata_pelajaran::findOrFail($id_mapel);

        // Delete mata_pelajaran
        $mata_pelajaran->delete();

        // Redirect
        return redirect()->route('admin.mata_pelajaran.index');
    }
}
