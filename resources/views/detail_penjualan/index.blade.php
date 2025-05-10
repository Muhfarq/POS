@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('detail_penjualan/create') }}">Tambah</a>
                <button onclick="modalAction('{{ url('detail_penjualan/create_ajax') }}')"
                    class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="Filter" class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select name="barang_id" id="barang_id" class="form-control">
                                <option value="">- Semua -</option>
                                @foreach($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach

                            </select>
                            <small class="form-text text-muted">Nama Barang</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_detail_penjualan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pembeli</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
            data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }
        var dataDetailPenjualan;
        $(document).ready(function () {
            dataDetailPenjualan = $('#table_detail_penjualan').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('detail_penjualan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.barang_id = $('#barang_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "penjualan.pembeli",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jumlah",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "action",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#barang_id').change(function () {
                dataDetailPenjualan.ajax.reload();
            });
        });
    </script>
@endpush