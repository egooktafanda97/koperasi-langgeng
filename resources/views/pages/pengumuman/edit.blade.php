@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-8">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('pengumuman.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Edit Pengumuman</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('pengumuman.update', $pengumuman->id) }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input class="form-control" name="judul" required type="text" value="{{ $pengumuman->judul }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Pengumuman</label>
                        <textarea class="form-control summernote" id="isi" name="isi" required rows="5">{{ $pengumuman->isi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Lampiran</label>
                        <input class="form-control" name="file_lampiran" type="file">
                        @if ($pengumuman->file_lampiran)
                            <br>
                            <a class="text-sm text-primary" href="{{ asset('storage/' . $pengumuman->file_lampiran) }}"
                                target="_blank">Lihat Lampiran Lama</a>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tampilkan?</label><br>
                        <input {{ $pengumuman->tampilkan ? 'checked' : '' }} name="tampilkan" type="checkbox"> Ya
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Update</button>
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
