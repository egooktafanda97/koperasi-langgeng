@extends('app.layout')

@section('content')
    <div class="container-fluid !p-0 text-gray-700">
        <div class="m-2 flex justify-between">
            <h3 class="h4">{{ $pengumuman->judul }}</h3>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center gap-2 m-2">
            <div class="flex w-full md:w-1/2">

            </div>
            <div class="flex gap-1">


            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body bg-white">
                    {!! $pengumuman->isi !!}
                </div>
            </div>
        </div>

    </div>
@endsection
