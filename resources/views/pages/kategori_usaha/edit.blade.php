@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('kategori_usaha.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Edit kategori usaha Usaha</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('kategori_usaha.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nama_kategori">Nama Kategori</label>
                        <input class="form-control" id="nama_kategori" name="nama_kategori"
                            placeholder="Contoh: Perkebunan, Jasa, Perdagangan" required type="text"
                            value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi tambahan (opsional)"
                            rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
