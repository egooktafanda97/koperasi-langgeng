@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('produk_saya.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Edit Produk Unit</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('produk_saya.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_produk">Nama Produk</label>
                            <input class="form-control" id="nama_produk" name="nama_produk" required type="text"
                                value="{{ old('nama_produk', $produk->nama_produk) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="jenis_produk">Jenis Produk</label>
                            <select class="form-control" id="jenis_produk" name="jenis_produk" required>
                                <option {{ $produk->jenis_produk == 'barang' ? 'selected' : '' }} value="barang">Barang
                                </option>
                                <option {{ $produk->jenis_produk == 'jasa' ? 'selected' : '' }} value="jasa">Jasa</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="satuan">Satuan</label>
                            <input class="form-control" id="satuan" name="satuan" type="text"
                                value="{{ old('satuan', $produk->satuan) }}">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $produk->keterangan) }}</textarea>
                        </div>
                    </div>

                    <div class="w-full text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
