@extends('app.layout')

@section('content')
    <div class="container text-gray-700">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white flex items-center justify-between">
                <div class="flex items-center">
                    <a class="text-white" href="{{ route('unit_usaha.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h5 class="p-0 m-0 ml-3">Edit Unit Usaha & Akun</h5>
                </div>
            </div>
        </div>

        <div class="card-body bg-white">
            <form action="{{ route('unit_usaha.update', $unit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Info Unit Usaha --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="nama_unit">Nama Unit Usaha</label>
                        <input class="form-control" id="nama_unit" name="nama_unit"
                            placeholder="Contoh: Unit Perkebunan Sawit" required type="text"
                            value="{{ old('nama_unit', $unit->nama_unit) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="kategori_usaha_id">Kategori Usaha</label>
                        <select class="form-control" id="kategori_usaha_id" name="kategori_usaha_id">
                            <option disabled selected value="">Pilih Kategori Usaha</option>
                            @foreach ($kategori as $item)
                                <option
                                    {{ $item->id == old('kategori_usaha_id', $unit->kategori_usaha_id) ? 'selected' : '' }}
                                    value="{{ $item->id }}">
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="penanggung_jawab">Penanggung Jawab</label>
                        <input class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                            placeholder="Nama kepala unit" type="text"
                            value="{{ old('penanggung_jawab', $unit->penanggung_jawab) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="phone">No. Telepon Unit</label>
                        <input class="form-control" id="phone" name="phone" placeholder="Contoh: 081234567890"
                            type="text" value="{{ old('phone', $unit->phone) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap unit usaha"
                            rows="2">{{ old('alamat', $unit->alamat) }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi singkat mengenai unit usaha"
                            rows="3">{{ old('deskripsi', $unit->deskripsi) }}</textarea>
                    </div>

                    <div class="col-12">
                        <hr class="my-4">
                        <h5>Edit Akun Unit</h5>
                    </div>

                    {{-- Akun User Unit --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="user_name">Nama Pengguna</label>
                        <input class="form-control" id="user_name" name="user_name"
                            placeholder="Nama lengkap pengguna akun unit" required type="text"
                            value="{{ old('user_name', $unit->users->first()->name ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="user_email">Email</label>
                        <input class="form-control" id="user_email" name="user_email"
                            placeholder="Contoh: user@unitdesa.com" required type="email"
                            value="{{ old('user_email', $unit->users->first()->email ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="user_phone">No. HP</label>
                        <input class="form-control" id="user_phone" name="user_phone" placeholder="Contoh: 081234567890"
                            type="text" value="{{ old('user_phone', $unit->users->first()->phone ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="user_address">Alamat Akun</label>
                        <textarea class="form-control" id="user_address" name="user_address" placeholder="Masukkan alamat pengguna akun"
                            rows="2">{{ old('user_address', $unit->users->first()->address ?? '') }}</textarea>
                    </div>
                </div>

                <div class="w-full text-end">
                    <button class="btn btn-primary w-[150px]" type="submit">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
@endsection
