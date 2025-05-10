@extends('app.layout')

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
@section('content')
    <div class="container-fluid !p-0 text-gray-700">
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
        useTable("{{ route('log-activity.show') }}", {
            contaner: "table-container",
            columns: ["No", "Subject type", "Description", "Causer", "Created At"],
            data: x => [x.no, x.subject_type, x.description, x?.causer?.name ?? '-', x.created_atx],
        })
    </script>
@endpush
