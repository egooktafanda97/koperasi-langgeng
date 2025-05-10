@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('laporan-me.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Tambah Laporan</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('laporan-me.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bulan</label>
                            <input class="form-control" name="bulan" required type="month">
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendapatan</label>
                            <input class="form-control" name="pendapatan" required type="number">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengeluaran</label>
                            <input class="form-control" name="pengeluaran" required type="number">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">File Laporan</label>
                            <input class="form-control" name="file_laporan" type="file">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
