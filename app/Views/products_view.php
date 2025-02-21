<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>Products <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <?= $this->include(config('Auth')->views['menu_layout']) ?>
    <div class="container">

        <div class="card col-12 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5">Products</h5>
                <table id="table" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pid</th>
                            <th>Name</th>
                            <th>UOM</th>
                            <th>WareHouse</th>
                            <th>Rack</th>
                            <th>Bin</th>
                            <th>Product Labels</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>pwid</th>
                            <th>prid</th>
                            <th>pbid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <input type="hidden" name="pid" id="pid" value="" />
                <input type="hidden" name="pwid" id="pwid" value="" />
                <input type="hidden" name="prid" id="prid" value="" />
                <input type="hidden" name="pbid" id="pbid" value="" />
            </div>
            <div class="modal-body"></div>
            <!-- <div class="modal-footer">

                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
        </div>
    <?= $this->include(config('Auth')->views['footer_layout']) ?>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {

            $(document).ready(function() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo site_url('products/ajaxProductsDataTables'); ?>',
                    order: [],
                    columnDefs: [
                        {
                            target: 2,
                            visible: false,
                            searchable: false
                        },
                        {
                            target: 11,
                            visible: false,
                            searchable: false
                        },
                        {
                            target: 12,
                            visible: false,
                            searchable: false
                        },
                        {
                            target: 13,
                            visible: false,
                            searchable: false
                        }
                    ],
                    columns: [
                        {data: 'no', orderable: false},
                        {data: 'pid', visible: false},
                        {data: 'name'},
                        {data: 'uom'},
                        {data: 'warehouses_name'},
                        {data: 'racks_name'},
                        {data: 'bins_name'},
                        {data: 'labels_name'},
                        {data: 'quantity'},
                        {data: 'status'},
                        {data: 'pwid', visible: false},
                        {data: 'prid', visible: false},
                        {data: 'pbid', visible: false},
                        // {data: 'action', orderable: false},
                        {
                            data: null,
                            className: 'dt-center edit',
                            defaultContent: '<button type="button" data-href="<?= site_url('product/edit') ?>" class="btn btn-primary btn-sm" data-id="" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-edit"></i> Edit</button>',
                            orderable: false
                        },
                        // {
                        //     data: null,
                        //     className: 'dt-center delete',
                        //     defaultContent: '<button><i class="fa fa-trash"/></button>',
                        //     orderable: false
                        // }
                    ],
                    rowCallback: function(row, data, index){
                        $(row).find('.edit').on('click', function() {
                            console.log('data.pid => '+data.pid);
                            console.log('data.pwid => '+data.pwid);
                            console.log('data.prid => '+data.prid);
                            console.log('data.pbid => '+data.pbid);
                            $('#pid').val(data.pid);
                            $('#pwid').val(data.pwid);
                            $('#prid').val(data.prid);
                            $('#pbid').val(data.pbid);
                            $('#myModalLabel').text('Edit');
                            $('#myModal').modal('show');

                        });
                    },
                    // responsive: {
                    //     details: {
                    //         display: $.fn.dataTable.Responsive.display.modal({
                    //             header: function (row) {
                    //                 var data = row.data();
                    //                 return 'Details for ' + data[0] + ' ' + data[1];
                    //             }
                    //         }),
                    //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    //             tableClass: 'table'
                    //         })
                    //     }
                    // }
                });

                $("#myModal").on("show.bs.modal", function(e) {
                    var link = $(e.relatedTarget);
                    $(this).find(".modal-body").load(link.attr("data-href"));


                });
                // Add record
                $('.add').on('click', function (e) {

                });
                // Edit record
                $('#table').on('click', 'td.edit button', function (e) {

                });
            });
        });
    </script>
<?= $this->endSection() ?>
