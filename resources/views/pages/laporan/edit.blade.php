@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('laporan.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Edit Laporan</h5>
                </div>
            </div>

            <div class="card-body bg-white">
                <form action="{{ route('laporan.update', $laporan->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit Usaha</label>
                            <select class="form-control" name="unit_id" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option {{ $laporan->unit_id == $unit->id ? 'selected' : '' }}
                                        value="{{ $unit->id }}">
                                        {{ $unit->nama_unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bulan</label>
                            <input class="form-control" name="bulan" required type="month"
                                value="{{ $laporan->bulan }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendapatan</label>
                            <input class="form-control" name="pendapatan" required type="number"
                                value="{{ $laporan->pendapatan }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengeluaran</label>
                            <input class="form-control" name="pengeluaran" required type="number"
                                value="{{ $laporan->pengeluaran }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">File Laporan</label>
                            <input class="form-control" name="file_laporan" type="file">
                            @if ($laporan->file_laporan)
                                <small class="text-muted">
                                    <a href="{{ asset('storage/' . $laporan->file_laporan) }}" target="_blank">
                                        Lihat File Lama
                                    </a>
                                </small>
                            @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3">{{ $laporan->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary w-[150px]" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
