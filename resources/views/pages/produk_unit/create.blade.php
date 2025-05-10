@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('produk_unit.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Tambah Produk Unit</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('produk_unit.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="unit_id">Unit</label>
                            <select class="form-control" id="unit_id" name="unit_id" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_produk">Nama Produk</label>
                            <input class="form-control" id="nama_produk" name="nama_produk"
                                placeholder="Contoh: Pupuk Organik" required type="text">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="jenis_produk">Jenis Produk</label>
                            <select class="form-control" id="jenis_produk" name="jenis_produk" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="barang">Barang</option>
                                <option value="jasa">Jasa</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="satuan">Satuan</label>
                            <input class="form-control" id="satuan" name="satuan" placeholder="Contoh: Kg, Layanan"
                                type="text">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan tambahan" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="w-full text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
