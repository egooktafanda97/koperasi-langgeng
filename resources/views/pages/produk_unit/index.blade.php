@extends('app.layout')

@section('content')
    <div class="container-fluid !p-0 text-gray-700">
        <div class="m-2 flex items-center justify-between">
            <h4 class="h4">Produk Unit</h4>
            <a class="btn btn-primary" href="{{ route('produk_unit.create') }}">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        <div id="table-container"></div>
    </div>
@endsection

@push('script')
    <script>
        useTable("{{ route('produk_unit.list') }}", {
            contaner: "table-container",
            columns: ["No", "Unit", "nama_produk", "jenis_produk", "unit", "satuan",
                {
                    name: "#",
                    formatter: (cell, row) => {
                        return gridjs.html(`
                            <a href="/produk-unit/edit/${row.cells[5].data}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="deleted('/produk-unit/${row.cells[5].data}/destroy')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>`);
                    },
                    attributes: () => ({
                        class: "text-center"
                    })
                }
            ],
            data: x => [x.no, x.unit.nama_unit, x.nama_produk, x.jenis_produk, x.unit.nama_unit, x.satuan, x.id],
        })
    </script>
@endpush
@push('style')
    <style>
        .gridjs-wrapper {
            box-shadow: none !important;
            border: none !important;
            border-radius: 0px;
        }

        .gridjs-footer {
            box-shadow: none !important;
            border: none !important;
            padding: .5rem !important;
            background-color: #101828;
            font-size: .8em !important;
            color: #fff;
            border-radius: 0;
        }

        .gridjs-tr {
            border-radius: 0 !important;
        }

        .gridjs-pagination {
            color: #fff;
        }

        .gridjs-table {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;

        }

        td.gridjs-td {
            padding: 0.4rem !important;

        }

        .gridjs-tr>th {
            padding: .5rem !important;
            background-color: #101828;
            font-size: .8em !important;
            color: #fff;
        }

        .gridjs-tr>td {
            padding: .5rem !important;
            font-size: .8em !important;
        }

        .gridjs-input.gridjs-search-input {
            padding: .5rem;
            height: 30px !important;
            border: 1px solid gray;
        }

        .gridjs-pages {
            color: #262626 !important;
        }
    </style>
@endpush
