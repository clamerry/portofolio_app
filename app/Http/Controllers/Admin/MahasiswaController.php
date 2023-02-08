<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurnal;
use App\Models\Kegiatan;
use App\Models\Project;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Traits\FakultasTrait;
use App\Traits\ProdiTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    use FakultasTrait, ProdiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.kelola_mhs.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fakultas = $this->listFakultas(); //this itu mengacu kepada class.

        if ($request->ajax()) {
            $prodi = $this->listProdi();
            return response()->json([
                'status' => 200,
                'data'  => $prodi
            ]);
        }
        return view('admin.kelola_mhs.create', compact('fakultas'));
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
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nim' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
        ]);

        $mhsData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nim' => $request->nim,
            'fakultas' => $this->findNameFakultas($request->fakultas),
            'prodi' => $this->findNameProdi($request->prodi),
        ];

        Mahasiswa::insert($mhsData);

        return redirect()->route('kelola_mahasiswa.index')
            ->withSuccess('Data mahasiswa berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show spesific data
        $mahasiswa = Mahasiswa::where('id', '=', $id)
            ->get();

        $prestasi = Prestasi::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();
        //$prestasi = [];

        // dd($prestasi);
        $project = Project::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();

        $jurnal = Jurnal::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();

        $kegiatan = Kegiatan::where('mahasiswa_id', $id)
            ->where('status', '!=', 'Ditolak')
            ->get();

        return view('admin.kelola_mhs.show', compact('mahasiswa', 'prestasi', 'project', 'jurnal', 'kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $fakultas = $this->listFakultas(); //this itu mengacu kepada class.
        $prodi = $this->listProdi();

        if ($request->ajax()) {
            $prodi = $this->listProdi();
            return response()->json([
                'status' => 200,
                'data'  => $prodi
            ]);
        }
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        return view('admin.kelola_mhs.edit', compact('mahasiswa', 'fakultas', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            'nim' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
        ]);

        // $file = $request->file('image');
        // $fileName = time() . '.' . $file->getClientOriginalExtension();
        // $file->storeAs('public/images', $fileName);

        $mhsData = [
            'nama' => $request->nama,
            'email' => $request->email,
            // 'password' => ($request->password),
            'nim' => $request->nim,
            'fakultas' => $this->findNameFakultas($request->fakultas),
            'prodi' => $this->findNameProdi($request->prodi),
        ];

        Mahasiswa::where('id', $id)
            ->update($mhsData);


        return redirect()->route('kelola_mahasiswa.index')
            ->withSuccess('Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Mahasiswa::where('id', $id)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Data berhasil dihapus";
        } else {
            $success = true;
            $message = "Data tidak ditemukan";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg|max:3000',
        ], [
            'image.image' => 'Berkas harus berupa gambar',
            'image.mimes' => 'Gambar bukan termasuk bentuk jpg, png, jpeg',
            'image.max' => 'Ukuran gambar lebih besar dari 3MB'
        ]);
        // dd($id, $request->file('image'), $request->hasFile('image'), $request);
        $mahasiswa = Mahasiswa::where('id', $id)->first();

        if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {

            if (!empty($mahasiswa->image)) {
                File::delete("storage/images/{$mahasiswa->image}");
            }
            // $data['image'] = $this->userRepo->saveCoverImage($request->file('image'));

            //upload image to storage
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            //upload image to DB
            $mahasiswa->update(['image' => $fileName,]);
        } else {
            return redirect()->back()->withDanger("Foto tidak boleh kosong");
        }
        return redirect()->back()->withSuccess("Foto Profil berhasil diperbarui");
    }
}
