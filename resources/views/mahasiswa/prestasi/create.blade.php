<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- From Only CSS-->
    <link href="{{ asset('form/css/main.css') }}" rel="stylesheet" media="all">

    <!-- Title Page-->
    <title>Tambah Prestasi</title>
</head>

<body>
    <!-- Create Prestasi Page -->
    <div class="page-wrapper bg-dark p-t-100 p-b-50" style="background: #4f5257;">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h5 class="title" style="font-size: 28px;">Tambah Prestasi Mahasiswa
                        <a class="btn right" href="{{ route('prestasi.index') }}"> Kembali<i class="fas fa-arrow-left"></i></a>
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="name">Judul</div>
                            <div class="value">
                                <input type="text" name="judul" class="input--style-6" placeholder="Judul" required>
                                @error('judul')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Deskripsi</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea name="deskripsi" class="textarea--style-6" placeholder="Deskripsi" required></textarea>
                                    @error('deskripsi')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Piagam/Sertifikat</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="form-control" style="" type="file" name="image" id="image" required>
                                    @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="label--desc">Upload your Certificate. Max file size 50 MB</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn--radius-2 btn--blue-2">Add Prestasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS for Form Only-->
    <script src="{{ asset('form/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Form Only JS -->
    <script src="{{ asset('form/js/global.js') }}"></script>
    </div>
</body>

</html>
