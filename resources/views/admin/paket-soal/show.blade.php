@extends('layouts.app')

@section('title', $paketSoal->name)

@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            {{ $paketSoal->name }}
        </h1>
    </div>
@endsection

@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-header d-flex justify-content-between">
            <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <input type="search" name="search" class="form-control form-control-solid w-250px ps-15" id="search"
                    placeholder="Cari.." />
            </div>
        </div>
        <div class="card-body pt-0">
            <table id="soal-detail-table" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th class="text-start min-w-100px">No</th>
                        <th class="text-start min-w-100px">Soal</th>
                        <th class="text-start min-w-100px">Soal Gambar</th>
                        <th class="text-center min-w-100px">Soal Audio</th>
                        {{-- <th class="text-start min-w-100px">Jawaban A</th>
                        <th class="text-start min-w-100px">Jawaban B</th>
                        <th class="text-start min-w-100px">Jawaban C</th>
                        <th class="text-start min-w-100px">Jawaban D</th>
                        <th class="text-start min-w-100px">Kunci Jawaban</th>
                        <th class="text-start min-w-100px">Point Soal</th> --}}
                        <th class="text-start min-w-100px">Kategori Soal</th>
                        <th class="text-start min-w-100px">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var datatable = $('#soal-detail-table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            stateSave: false,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: true,
                    searchable: true,
                    width: '10%'
                },
                {
                    data: 'question',
                    name: 'question',
                    orderable: true,
                    searchable: true,
                    width: '30%',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            if (data.length > 100) {
                                return data.slice(0, 100);
                            } else {
                                return data;
                            }
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'question_image',
                    name: 'question_image',
                    orderable: true,
                    searchable: true,
                    width: '20%',
                },
                {
                    data: 'question_audio',
                    name: 'question_audio',
                    orderable: true,
                    searchable: true,
                    width: '20%',
                },
                {
                    data: 'category_soal',
                    name: 'category_soal',
                    orderable: true,
                    searchable: true,
                    width: '20%'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ],
            order: [
                [0, "asc"]
            ]
        })
        $('#search').on('keyup', function() {
            datatable.search(this.value).draw();
        });
    </script>
@endpush
