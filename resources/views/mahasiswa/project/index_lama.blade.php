@section('extra-css')
    <!-- Datatables, SweetAlert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@extends('layouts.auth.app')

@section('content')
    @csrf
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <a class="btn btn-outline" style="float: left" href="/mahasiswa"><i class="fas fa-arrow-left"></i>
                            Kembali</a>
                        <h4 class="mt-1" style="float: right">Kelola Project</h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Tabel Project -->
        <section class="content">
            <div class="container-fluid">

                <body class="bg-light">
                    <div class="container">
                        <div class="row my-5">
                            <div class="col-lg-12">
                                <div class="card shadow">
                                    <div class="card-header d-flex justify-content-between align-items-center justify-content-md-end"
                                        style="margin-top: -2rem; background: #2c6ed5">
                                        <a class="btn btn-light" href="{{ route('project.create') }}"><i
                                                class="bi-plus-circle me-2"></i>Tambah
                                            Project</a>
                                    </div>
                                    <div class="card-body" id="show_all_project">
                                        <table id="tabel_project"
                                            class="table table-striped table-sm text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Judul</th>
                                                    <th>Deskripsi</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($project as $prj)
                                                    <tr>
                                                        <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                                        <td style="vertical-align: middle">{{ $prj->judul }}</td>
                                                        <td style="vertical-align: middle"><button type="button"
                                                                class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#view_deskripsi{{ $prj->id }}">
                                                                Show
                                                            </button></td>
                                                        <td style="vertical-align: middle"><button type="button"
                                                                class="btn btn-outline-primary" data-toggle="modal"
                                                                data-target="#view_image{{ $prj->id }}">
                                                                Show
                                                            </button>
                                                        </td>
                                                        <td style="vertical-align: middle">{{ $prj->status }}</td>
                                                        <td style="vertical-align: middle">
                                                            <form action="{{ route('project.destroy', $prj->id) }}"
                                                                method="POST">
                                                                <a style="background:transparent; text-decoration: none; vertical-align: middle"
                                                                    href="{{ route('project.edit', $prj->id) }}">
                                                                    <i class="nav-icon fas fa-edit fa-lg"
                                                                        style="color: #0f394c"></i></a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="border-0"
                                                                    style="background: transparent; vertical-align: middle">
                                                                    <i class="nav-icon far fa-trash-alt fa-lg"
                                                                        style="color: red"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @foreach ($project as $prj)
                        <!-- Modal View Deskripsi -->
                        <div class="modal fade" id="view_deskripsi{{ $prj->id }}">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Description</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $prj->deskripsi }}</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <!-- Modal View Image -->
                        <div class="modal fade" id="view_image{{ $prj->id }}">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Description</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/images/' . $prj->image) }}">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endforeach

                    <!-- Datatables, SweetAlert -->
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                    <script src="sweetalert2.all.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#tabel_project').DataTable();
                        });
                    </script>
                </body>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('extra-package')
    <!-- Datatables, SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
