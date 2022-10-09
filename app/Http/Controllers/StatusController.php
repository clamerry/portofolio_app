<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Project;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //   
    }
    public function indexPrestasi()
    {
        $prestasi = Prestasi::join('mahasiswa', 'prestasis.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'prestasis.id as id_prestasi', 'prestasis.judul', 'prestasis.status', 'prestasis.image'])
            ->where('status', '=', 'Menunggu Verifikasi');

        /*SQL Join Command
        SELECT mahasiswa.id, mahasiswa.nama, prestasis.judul, prestasis.status, prestasis.image
        FROM prestasi
        INNER JOIN mahasiswa ON mahasiswa.id = prestasis.mahasiswa_id*/

        return view('admin.kelola_status.status_prestasi', compact('prestasi'));
    }

    public function indexProject()
    {
        $project = Project::join('mahasiswa', 'projects.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'projects.id as id_project', 'projects.judul', 'projects.deskripsi', 'projects.image', 'projects.status'])
            ->where('status', '=', 'Menunggu Verifikasi');

        return view('admin.kelola_status.status_project', compact('project',));
    }

    public function indexJurnal()
    {
        $jurnal = Jurnal::join('mahasiswa', 'jurnals.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'jurnals.id as id_jurnal', 'jurnals.judul', 'jurnals.penulis', 'jurnals.jurnal', 'jurnals.file', 'jurnals.status'])
            ->where('status', '=', 'Menunggu Verifikasi');

        return view('admin.kelola_status.status_jurnal', compact('jurnal',));
    }
    public function indexKegiatan()
    {
        $kegiatan = Kegiatan::join('mahasiswa', 'kegiatans.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'kegiatans.id as id_kegiatan', 'kegiatans.jabatan', 'kegiatans.kegiatan', 'kegiatans.periode', 'kegiatans.image', 'kegiatans.status'])
            ->where('status', '=', 'Menunggu Verifikasi');

        return view('admin.kelola_status.status_kegiatan', compact('kegiatan',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePrestasiStatus($id_prestasi)
    {
        $prsStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update prestasi sesuai id yang dipilih
        Prestasi::where('id', $id_prestasi)
            ->update($prsStatus);

        // model form biasa
        //return redirect()->route('index.prestasi');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectPrestasi($id_prestasi)
    {
        $prsStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update prestasi sesuai id yang dipilih
        Prestasi::where('id', $id_prestasi)
            ->update($prsStatus);

        // return redirect()->route('index.prestasi');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }

    public function updateProjectStatus($id_project)
    {
        $prjStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update project sesuai id yang dipilih
        Project::where('id', $id_project)
            ->update($prjStatus);

        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectProject($id_project)
    {
        $prjStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update prestasi sesuai id yang dipilih
        Project::where('id', $id_project)
            ->update($prjStatus);

        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }

    public function updateJurnalStatus($id_jurnal)
    {
        $jrnlStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update jurnal sesuai id yang dipilih
        Jurnal::where('id', $id_jurnal)
            ->update($jrnlStatus);

        // model form biasa
        //return redirect()->route('index.jurnal');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectJurnal($id_jurnal)
    {
        $jrnlStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update jurnal sesuai id yang dipilih
        Jurnal::where('id', $id_jurnal)
            ->update($jrnlStatus);

        // return redirect()->route('index.jurnal');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }

    public function updateKegiatanStatus($id_kegiatan)
    {
        $kgtStatus = [
            'status' => 'Telah diverifikasi'
        ];
        //untuk update kegiatan sesuai id yang dipilih
        Kegiatan::where('id', $id_kegiatan)
            ->update($kgtStatus);

        // model form biasa
        //return redirect()->route('index.kegiatan');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data telah disetujui']);
    }
    public function rejectKegiatan($id_kegiatan)
    {
        $kgtStatus = [
            'status' => 'Ditolak'
        ];
        //untuk update kegiatan sesuai id yang dipilih
        Kegiatan::where('id', $id_kegiatan)
            ->update($kgtStatus);

        // return redirect()->route('index.kegiatan');

        // model ajax
        return response()->json(['success' => true, 'message' => 'Data ditolak']);
    }
}
