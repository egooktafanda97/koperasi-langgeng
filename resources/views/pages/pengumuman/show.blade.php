@extends('app.layout')

@section('content')
    <div class="container-fluid !p-0 text-gray-700">
        <div class="m-2 flex justify-between">
            <h4 class="h4">Pengumuman</h4>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center gap-2 m-2">
            <div class="flex w-full md:w-1/2">

            </div>

            <!-- Action Buttons -->
            <div class="flex gap-1">

            </div>
        </div>



        <div id="table-container"></div>
    </div>
@endsection
@push('script')
    <script>
        useTable("{{ route('pengumuman.list') }}", {
            contaner: "table-container",
            columns: ["No", "Judul",
                {
                    name: "#",
                    formatter: (cell, row) => {
                        return gridjs.html(`
                            <a href="/pengumuman/pages-show/${row.cells[2].data}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>`);
                    },
                    attributes: () => ({
                        class: "text-center"
                    })
                }
            ],
            data: x => [x.no, x.judul, x.id],
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
