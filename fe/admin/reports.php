<?php 

$columns = [
    'Tanggal' => 2,
    'No Ticket' => 3,
    'Masuk' => 4,
    'Keluar' => 5,
    'No. Kendaraan' => 6,
    'Driver' => 7,
    'Supplier Group' => 8,
    'Nama Supplier' => 9,
    'Muatan' => 10,
    'Bruto' => 11,
    'Tara' => 12,
    'Netto 1' => 13,
    'Potongan' => 14,
    'Netto 2' => 15,
    'Harga' => 16,
    'DPP' => 17,
    'PPH' => 18,
    'SPSI' => 19,
    'Total Pembayaran' => 20,
];

loadFile('fe/partials/header'); 
?>
<style>
table td, table th {white-space: nowrap;}
/* Card style untuk wrapper */
.dataTables_wrapper {
  background: #fff;
  border-radius: 16px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  font-family: 'Inter', 'Poppins', sans-serif;
  font-size: 14px;
  color: #333;
}

/* Table header */
table.dataTable thead th {
  background: #f9fafb;
  font-weight: 600;
  padding: 12px 10px;
  border-bottom: 2px solid #e5e7eb;
}

/* Table rows */
table.dataTable tbody tr {
  background: #fff;
  border-radius: 8px;
  transition: all 0.2s ease-in-out;
}

table.dataTable tbody tr:nth-child(even) {
  background: #fdfdfd;
}

table.dataTable tbody tr:hover {
  background: #f1f5f9;
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}

/* Table cells */
table.dataTable tbody td {
  padding: 10px;
  vertical-align: middle;
  border-top: 1px solid #f1f5f9;
}

/* Highlight kolom tertentu */
table.dataTable tbody td:nth-child(2) { /* No Ticket */
  font-weight: 600;
  color: #1e40af;
}
table.dataTable tbody td:nth-child(5) { /* No Kendaraan */
  font-weight: 600;
  color: #047857;
}

.dataTables_paginate {
  display: flex;
  overflow-x: auto;
  gap: 4px;
}

.dataTables_paginate .paginate_button {
  flex: 0 0 auto; /* biar ukuran tetap */
}

/* Length & Search box */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
  margin-bottom: 15px;
}

.dataTables_wrapper .dataTables_filter input {
  border-radius: 8px;
  border: 1px solid #d1d5db;
  padding: 6px 10px;
  outline: none;
  transition: border 0.2s;
}

.dataTables_wrapper .dataTables_filter input:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 1px #2563eb;
}

</style>
    <div class="app-content">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="page-description d-flex align-items-center">
                            <div class="page-description-content flex-grow-1 d-flex justify-content-between">
                                <h1>Data Rekapitulasi Pembelian</h1>

                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="material-icons-outlined">filter_list</i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card widget widget-stats">
                            <div class="card-body">
                                <div class="widget-stats-container d-flex">
                                    <div class="widget-stats-icon widget-stats-icon-danger">
                                        <i class="material-icons-outlined">file_download</i>
                                    </div>
                                    <div class="widget-stats-content flex-fill">
                                        <span class="widget-stats-title">Netto</span>
                                        <span class="widget-stats-amount" id="netto">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table id="datatable1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <?php foreach ($columns as $col => $index): ?>
                                        <th><?= htmlspecialchars($col) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-4">
                                            <label for="" class="mb-1">No. Kendaran</label>
                                            <input type="text" id="no_kendaraan" class="form-control">
                                        </div>
                                        <?php if(auth()['level'] == 'admin'): ?>
                                        <div class="form-group mb-4">
                                            <label for="" class="mb-1">Supplier Group</label>
                                            <input type="text" id="supplier_group" class="form-control">
                                        </div>
                                        <?php endif ?>
                                        <div class="form-group mb-4">
                                            <label for="" class="mb-1">Nama Supplier</label>
                                            <input type="text" id="nama_supplier" class="form-control">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="" class="mb-1">Tanggal Awal</label>
                                            <input type="date" id="tanggal_awal" class="form-control">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="" class="mb-1">Tanggal Akhir</label>
                                            <input type="date" id="tanggal_akhir" class="form-control">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="" class="mb-1">Driver</label>
                                            <input type="text" id="driver" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="doFilter()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php loadFile('fe/partials/footer', implode(' ', [
    '<script src="assets/plugins/datatables/datatables.min.js"></script>',
    "<script>const dataTable = $('#datatable1').on('draw.dt', function (e, settings, json, xhr) {
        document.querySelector('#datatable1').parentNode.classList.add('table-responsive')

        const nk  = $('#no_kendaraan').val()
        const ns  = $('#nama_supplier').val()
        const tgl1 = $('#tanggal_awal').val()
        const tgl2 = $('#tanggal_akhir').val()
        const drv = $('#driver').val()
        const sp = $('#supplier_group').length ? $('#supplier_group').val() : ''

        fetch('/report-data-statistic?filter[no_kendaraan]='+nk+'&filter[nama_supplier]='+ns+'&filter[tanggal_awal]='+tgl1+'&filter[tanggal_akhir]='+tgl2+'&filter[driver]='+drv+'&filter[supplier_group]='+sp)
            .then(res => res.json())
            .then(res => {
                // $('#bruto').html(res.data.total_bruto)
                // $('#tara').html(res.data.total_tara)
                $('#netto').html(res.data.total_netto_2)
            })
    }).DataTable({
    processing: true,
    serverSide: true,
    filter: false,
    ajax: {
        url: '/report-data',
        type: 'GET',
        data: function (d) {
            d.filter = {}
            d.filter.no_kendaraan  = $('#no_kendaraan').val();
            d.filter.supplier_group = $('#supplier_group').val();
            d.filter.nama_supplier = $('#nama_supplier').val();
            d.filter.tanggal_awal       = $('#tanggal_awal').val();
            d.filter.tanggal_akhir       = $('#tanggal_akhir').val();
            d.filter.driver        = $('#driver').val();
        }
    },
}); function doFilter(){ dataTable.draw(); $('#exampleModal').modal('hide') }</script>",
])) ?>