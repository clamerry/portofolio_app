<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestasi = Prestasi::where('mahasiswa_id', auth()->user()->id)->get();
        return view('mahasiswa.prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $prsData = [
            'mahasiswa_id' => auth()->user()->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $fileName
        ];

        Prestasi::insert($prsData);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestasi $prestasi)
    {
        //
        return view('mahasiswa.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        //
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $prsData = [
            'mahasiswa_id' => auth()->user()->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'image' => $fileName
        ];

        Prestasi::where('id', $prestasi->id)
            ->update($prsData);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestasi $prestasi)
    {
        //
        Prestasi::destroy($prestasi->id);
        return redirect()->route('prestasi.index')
            ->with('success', 'prestasi has been deleted successfully');
    }
}
