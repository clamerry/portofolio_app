<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurnal;
use App\Models\Project;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mahasiswa aktif
        $mahasiswa = Mahasiswa::all()->count();

        //prestasi (v)
        $prestasi = [
            'verifikasi' => Prestasi::where('status', 'Telah diverifikasi')->get()->count(),
            'total' => Prestasi::all()->count()
        ];

        //preview tabel prestasi
        $dataPrs = Prestasi::join('mahasiswa', 'prestasis.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'prestasis.id as id_prestasi', 'prestasis.judul', 'prestasis.status'])
            ->where('status', '=', 'Menunggu Verifikasi')
            ->take(5);

        //project (v)
        $project = [
            'verifikasi' => Project::where('status', 'Telah diverifikasi')->get()->count(),
            'total' => Project::all()->count()
        ];

        //preview tabel project
        $dataPrj = Project::join('mahasiswa', 'projects.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'projects.id as id_project', 'projects.judul', 'projects.status'])
            ->where('status', '=', 'Menunggu Verifikasi')
            ->take(5);

        //jurnal (v)
        $jurnal = [
            'verifikasi' => Jurnal::where('status', 'Telah diverifikasi')->get()->count(),
            'total' => Jurnal::all()->count()
        ];

        //preview tabel jurnal
        $dataJrnl = Jurnal::join('mahasiswa', 'jurnals.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'jurnals.id as id_jurnal', 'jurnals.judul', 'jurnals.status'])
            ->where('status', '=', 'Menunggu Verifikasi')
            ->take(5);

        //kegiatan (v)
        $kegiatan = [
            'verifikasi' => Kegiatan::where('status', 'Telah diverifikasi')->get()->count(),
            'total' => Kegiatan::all()->count()
        ];

        //preview tabel kegiatan
        $dataKgt = Kegiatan::join('mahasiswa', 'kegiatans.mahasiswa_id', '=', 'mahasiswa.id')
            ->get(['mahasiswa.nama', 'kegiatans.id as id_kegiatan', 'kegiatans.kegiatan', 'kegiatans.status'])
            ->where('status', '=', 'Menunggu Verifikasi')
            ->take(5);

        return view('admin.dashboard', compact('mahasiswa', 'prestasi', 'dataPrs', 'project', 'dataPrj', 'jurnal', 'dataJrnl', 'kegiatan', 'dataKgt'));
    }

}
