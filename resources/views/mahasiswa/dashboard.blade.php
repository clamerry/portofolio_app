@section('inline-css')
    <link href="{{ asset('landing_page/test.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@extends('layouts.auth.app')

@section('flashMessage')
@if (Session::has('success'))
    <script>
        swal.fire("Sukses!", "{{Session::get('success')}}", "success");
    </script>
@endif
@if (Session::has('danger'))
    <script>
        swal.fire("Ups! terjadi kesalahan", "{{Session::get('danger')}}", "danger");
    </script>
@endif
@endsection

@section('content')
    @csrf
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Dashboard Mahasiswa
                        </h4>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm" style="margin-top: -20px">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ auth()->user()->image ? asset('storage/images/'.auth()->user()->image) : asset('storage/images/blank.png')}}" alt="..."
                                        class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>{{ Auth::user()->nama }}</h4>
                                        <p class="text-secondary mb-1">{{ Auth::user()->nim }}</p>
                                    </div>
                                    <div class="mt-3"></div>
                                    <form action="{{ route('tambahFoto', [auth()->user()->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group js-input-file justify-content-center">
                                            <input class="form-control" style="display:none" type="file" name="image" id="image" onchange="this.form.submit()">
                                            <label for="image" class="text-center">
                                                <span class="btn text-white btn--blue btn-sm" style="border: 0px" >
                                                    Upload Photo
                                                </button>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body" style="">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Fakultas</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->fakultas }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Program Studi</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->prodi }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                                <hr>
                                
                            </div>
                            <div class="row; p-2" style="padding-bottom: 1rem !important">
                                <div class="col-sm-6">
                                    <button type="button" class="btn text-white btn--blue btn--radius-2 mt-3 btn-sm"
                                        style="border: 0px; margin-top: 0 !important" data-bs-toggle="modal" data-bs-target="#changePassword">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('updatePasswordMhs') }}" id="form" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" name="old_password" class="form-control" id="old_password" required>
                                        @if ($errors->any('old_password'))
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" class="form-control" id="new_password" required>
                                        @if ($errors->any('new_password'))
                                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            id="confirm_password" required>
                                        @if ($errors->any('confirm_password'))
                                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change
                                        Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-package')
    <script src="{{ asset('lte\plugins\jquery-validation\jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@section('inlinejs')
    <script>
        $(document).ready(function() {
            $('#tabel_prestasi').DataTable();
        });
    </script>
@endsection
