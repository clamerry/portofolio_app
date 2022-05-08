<title>Prestasi Mahasiswa</title>

<!-- Datatables, SweetAlert -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="sweetalert2.min.css">

@extends('layouts.auth.app')

@section('content')
    @csrf
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Kelola Prestasi</h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Tabel Prestasi -->
        <section class="content">
            <div class="container-fluid">

                <body class="bg-light">
                    <div class="container">
                        <div class="row my-5">
                            <div class="col-lg-12">
                                <div class="card shadow">
                                    <div class="card-header bg-danger d-flex justify-content-between align-items-center justify-content-md-end"
                                        style="margin-top: -2rem">
                                        <a class="btn btn-light" href="{{ route('prestasi.create') }}"><i
                                                class="bi-plus-circle me-2"></i>Add New
                                            Prestasi</a>
                                    </div>
                                    <div class="card-body" id="show_all_prestasi">
                                        <table id="tabel_prestasi"
                                            class="table table-striped table-sm text-center align-middle">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Judul</th>
                                                    <th>Deskripsi</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prestasi as $prs)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $prs->judul }}</td>
                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#view_deskripsi{{ $prs->id }}">
                                                                View Deskripsi
                                                            </button></td>
                                                        <td><button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#view_image{{ $prs->id }}">
                                                                View Image
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('prestasi.destroy', $prs->id) }}"
                                                                method="POST">
                                                                <a class="text-success mx-1 editIcon"
                                                                    href="{{ route('prestasi.edit', $prs->id) }}">
                                                                    <i class="bi-pencil-square h4"></i></a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-danger mx-1 deleteIcon">
                                                                    <i class="bi-trash h4"></i></a>
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


                    @foreach ($prestasi as $prs)
                        <!-- Modal View Deskripsi -->
                        <div class="modal fade" id="view_deskripsi{{ $prs->id }}">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Description</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $prs->deskripsi }}</p>
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
                        <div class="modal fade" id="view_image{{ $prs->id }}">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Description</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/images/' . $prs->image) }}">
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
                            $('#tabel_prestasi').DataTable();
                        });
                    </script>
                </body>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
