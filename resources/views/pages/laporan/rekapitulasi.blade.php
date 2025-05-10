@extends('app.layout')

@section('content')
    <div class="container-fluid !p-0 text-gray-700">
        <div class="m-2 flex items-center justify-between">
            <h4 class="h4">Data Laporan</h4>
            <div class="flex gap-2">
                <!-- Filter Status -->
                <form action="" class="flex gap-2" method="GET">
                    <select class="form-control" name="status">
                        <option value="">Semua Status</option>
                        <option {{ request('status') == 'menunggu' ? 'selected' : '' }} value="menunggu">Menunggu</option>
                        <option {{ request('status') == 'diterima' ? 'selected' : '' }} value="diterima">Diterima</option>
                        <option {{ request('status') == 'ditolak' ? 'selected' : '' }} value="ditolak">Ditolak</option>
                    </select>

                    <!-- Filter Unit -->
                    <select class="form-control" name="unit_id">
                        <option value="">Semua Unit</option>
                        @foreach (\App\Models\Unit::all() as $unit)
                            <option {{ request('unit_id') == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">
                                {{ $unit->nama_unit }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Bulan -->
                    {{-- <select class="form-control" name="bulan">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option {{ request('bulan') == $i ? 'selected' : '' }} value="{{ $i }}">
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select> --}}
                    <input class="form-control" name="bulan" type="month" />

                    <button class="btn btn-secondary" type="submit">
                        Cari
                    </button>
                </form>

                <button class="btn btn-primary" id="printButton">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>

        <div id="table-container"></div>
    </div>
    <div aria-hidden="true" aria-labelledby="filePreviewModalLabel" class="modal fade" id="filePreviewModal" role="dialog"
        tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body !p-0 text-center">
                    <!-- Preview Image -->
                    <img alt="file preview" class="img-fluid d-none" id="fileImagePreview">

                    <!-- Preview PDF -->
                    <iframe class="w-100 d-none" id="filePdfPreview" style="height: 90vh;"></iframe>

                    <!-- Google Docs Viewer for Word & Excel -->
                    <iframe class="w-100 d-none" id="fileGoogleDocsPreview" style="height: 500px;"></iframe>

                    <!-- Plain Text Preview -->
                    <pre class="d-none" id="fileTextPreview"></pre>

                    <!-- Fallback Icon -->
                    <img alt="file icon" class="img-fluid" id="fileIconPreview">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const tables = new gridjs.Grid({
            columns: ["No", "unit", "bulan", "pendapatan", "pengeluaran",
                {
                    name: "status",
                    formatter: (cell, row) => {
                        const status = cell;
                        // Warna badge
                        let badgeClass = '';
                        switch (status) {
                            case 'diterima':
                                badgeClass = 'badge bg-success';
                                break;
                            case 'ditolak':
                                badgeClass = 'badge bg-danger';
                                break;
                            case 'menunggu':
                            default:
                                badgeClass = 'badge bg-warning text-dark';
                                break;
                        }
                        return gridjs.html(`
                        <div class="d-flex align-items-center gap-2">
                            <span class="${badgeClass}">${status}</span>
                        </div>
                        `);
                    },
                    attributes: () => ({
                        class: "text-center"
                    })
                },
                {
                    name: "#",
                    formatter: (cell, row) => {
                        return gridjs.html(`
                        <button onclick="showFile(${row.cells[6].data})" class="btn btn-sm btn-info">
                            <i class='fas fa-eye'></i> Lihat File
                        </button>
                        `);
                    },
                    attributes: () => ({
                        class: "text-center"
                    })
                }
            ],
            resizable: true,
            server: {
                url: "{{ route('laporan.rekapitulasi.list') }}",
                then: (x) => x.data.map(x => [x.no, x.unit?.nama_unit ?? "", x.bulan, formatRupiah(x?.pendapatan ??
                        0
                    ),
                    formatRupiah(x?.pengeluaran ?? 0), x
                    ?.status, x.id
                ]),
                total: (response) => response.total,
            },
            pagination: {
                enabled: true,
                limit: 10,
                server: {
                    url: (prev, page, limit) =>
                        `${prev}?page=${page + 1}&limit=${limit}`,
                },
            },
        }).render(document.getElementById("table-container"));

        function showFile(id) {
            axios.get(`/laporan/file-path/${id}`, {
                    headers: {
                        'user_id': '{{ auth()?->user()?->id ?? null }}'
                    }
                })
                .then((r) => {
                    const result = r.data;
                    const filePath = result;
                    const fileExt = result?.ext?.toLowerCase() ?? 'pdf';

                    $("#fileImagePreview, #filePdfPreview, #fileGoogleDocsPreview, #fileTextPreview, #fileIconPreview")
                        .addClass("d-none");

                    // Jika file adalah gambar (PNG, JPG, JPEG, GIF, SVG)
                    if (['png', 'jpg', 'jpeg', 'gif', 'svg'].includes(fileExt)) {
                        $("#fileImagePreview").attr("src", filePath).removeClass("d-none");
                    }
                    // Jika file adalah PDF
                    else if (fileExt === 'pdf') {
                        $("#filePdfPreview").attr("src", filePath).removeClass("d-none");
                    }
                    // Jika file adalah Word atau Excel (Gunakan Google Docs Viewer)
                    else if (['doc', 'docx', 'xls', 'xlsx'].includes(fileExt)) {
                        $("#fileGoogleDocsPreview").attr("src",
                            `https://docs.google.com/gview?url=${window.location.origin}${filePath}&embedded=true`
                        ).removeClass("d-none");
                    }
                    // Jika file adalah TXT (Tampilkan sebagai teks)
                    else if (fileExt === 'txt') {
                        axios.get(filePath)
                            .then(textResponse => {
                                $("#fileTextPreview").text(textResponse.data).removeClass("d-none");
                            })
                            .catch(() => {
                                $("#fileIconPreview").attr("src", `/storage/txt.png`).removeClass("d-none");
                            });
                    }
                    // Jika file tidak didukung, tampilkan ikon default
                    else {
                        $("#fileIconPreview").attr("src", `/storage/file-icon.png`).removeClass("d-none");
                    }

                    // Tampilkan modal
                    $("#filePreviewModal").modal("show");
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        $("form").on("submit", function(e) {
            e.preventDefault();
            const formObject = $(this).serializeArray();
            const formData = {};
            formObject.forEach((item) => {
                formData[item.name] = item.value;
            });
            tables.updateConfig({
                server: {
                    url: "{{ route('laporan.rekapitulasi.list') }}",
                    headers: formData,
                    then: (x) => x.data.map(x => [x.no, x.unit?.nama_unit ?? "", x.bulan, formatRupiah(x
                            ?.pendapatan ??
                            0
                        ),
                        formatRupiah(x?.pengeluaran ?? 0), x
                        ?.status, x.id
                    ]),
                }
            }).forceRender();

        });

        // print & params
        $("#printButton").on("click", function() {
            const valueSerach = {
                status: $("select[name='status']").val(),
                unit_id: $("select[name='unit_id']").val(),
                bulan: $("input[name='bulan']").val()
            }
            const params = new URLSearchParams(valueSerach).toString();
            const url = "{{ route('laporan.rekapitulasi.print') }}?" + params;
            window.open(url, '_blank');
        });
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
