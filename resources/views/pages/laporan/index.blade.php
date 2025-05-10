@extends('app.layout')

@section('content')
    <div class="container-fluid !p-0 text-gray-700">
        <div class="m-2 flex items-center justify-between">
            <h4 class="h4">Data Laporan</h4>
            <a class="btn btn-primary" href="{{ route('laporan.create') }}">
                <i class="fas fa-plus"></i> Tambah Laporan
            </a>
        </div>

        <div id="table-container"></div>
    </div>
    <!-- Modal untuk Preview File -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        const tables = useTable("{{ route('laporan.masuk.list') }}", {
            contaner: "table-container",
            columns: ["No", "unit", "bulan", "pendapatan", "pengeluaran",
                {
                    name: "status",
                    formatter: (cell, row) => {
                        const status = cell;
                        const id = row.cells[6].data; // pastikan ini ID unik data (misal primary key)

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

                        // Dropdown options
                        const options = ['menunggu', 'diterima', 'ditolak']
                            .map(opt =>
                                `<option value="${opt}" ${opt === status ? 'selected' : ''}>${opt}</option>`
                            )
                            .join('');

                        return gridjs.html(`
                        <div class="d-flex align-items-center gap-2">
                            <span class="${badgeClass}">${status}</span>
                            <select class="form-select form-select-sm" style="width:auto;" onchange="changeStatus('${id}', this.value)">
                            ${options}
                            </select>
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

                        <a href="/laporan/edit/${row.cells[6].data}" class="btn btn-sm btn-primary">
                            <i class='fas fa-edit'></i> Edit
                        </a>
                        
                        `);
                    },
                    attributes: () => ({
                        class: "text-center"
                    })
                }
            ],
            data: x => [x.no, x.unit.nama_unit, x.bulan, formatRupiah(x.pendapatan), formatRupiah(x.pengeluaran), x
                .status, x.id
            ]
        })

        function changeStatus(id, newStatus) {
            axios.post(`/laporan/change-status`, {
                    id: id,
                    status: newStatus
                })
                .then(response => {
                    tables.forceRender()
                })
                .catch(error => {
                    // Handle error response
                    console.error(error);
                });
        }

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
