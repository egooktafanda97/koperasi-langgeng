@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-8">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('pengumuman.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Tambah Pengumuman</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('pengumuman.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input class="form-control" name="judul" required type="text">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Pengumuman</label>
                        <textarea class="form-control summernote" id="isi" name="isi" required rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Lampiran</label>
                        <input class="form-control" name="file_lampiran" type="file">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tampilkan?</label><br>
                        <input checked name="tampilkan" type="checkbox"> Ya
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <!-- Summernote -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });
        });
    </script>
@endpush
