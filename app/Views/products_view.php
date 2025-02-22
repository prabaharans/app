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
                            <th>puid</th>
                            <th>pwid</th>
                            <th>prid</th>
                            <th>pbid</th>
                            <th>plid</th>
                            <th>pdid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:hidden;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <input type="hidden" name="pid" id="pid" value="" />
                <input type="hidden" name="puid" id="puid" value="" />
                <input type="hidden" name="pwid" id="pwid" value="" />
                <input type="hidden" name="prid" id="prid" value="" />
                <input type="hidden" name="pbid" id="pbid" value="" />
                <input type="hidden" name="plid" id="plid" value="" />
                <input type="hidden" name="pdid" id="pdid" value="" />
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
                        },
                        {
                            target: 14,
                            visible: false,
                            searchable: false
                        },
                        {
                            target: 15,
                            visible: false,
                            searchable: false
                        },
                        {
                            target: 16,
                            visible: false,
                            searchable: false
                        }
                    ],
                    columns: [
                        {data: 'no', orderable: false},
                        {data: 'pid', visible: false},
                        {data: 'name'},
                        {data: 'uoms_name'},
                        {data: 'warehouses_name'},
                        {data: 'racks_name'},
                        {data: 'bins_name'},
                        {data: 'labels_name'},
                        {data: 'quantity'},
                        {data: 'status'},
                        {data: 'puid', visible: false},
                        {data: 'pwid', visible: false},
                        {data: 'prid', visible: false},
                        {data: 'pbid', visible: false},
                        {data: 'plid', visible: false},
                        {data: 'pdid', visible: false},
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
                        $(row).find('.edit').on('click', function(e) {
                            e.stopImmediatePropagation();
                            console.log('data.pid => '+data.pid);
                            console.log('data.puid => '+data.puid);
                            console.log('data.pwid => '+data.pwid);
                            console.log('data.prid => '+data.prid);
                            console.log('data.pbid => '+data.pbid);
                            console.log('data.plid => '+data.plid);
                            console.log('data.pdid => '+data.pdid);
                            $('#pid').val(data.pid);
                            $('#puid').val(data.puid);
                            $('#pwid').val(data.pwid);
                            $('#prid').val(data.prid);
                            $('#pbid').val(data.pbid);
                            $('#plid').val(data.plid);
                            $('#pdid').val(data.pdid);
                            // setTimeout(function() {
                                $('#myModalLabel').text('Edit');
                                $('#myModal').modal('show');
                            // }, 10);
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

                // Add record
                $('.add').on('click', function (e) {

                });
                // Edit record
                $('#table').on('click', 'td.edit button', function (e) {

                });
                // $('.select2').each(function() {
                //     $(this).select2({ dropdownParent: $(this).parent()});
                // })
                // setTimeout(function() {
                    // console.log('wid => '+wid);
                    // console.log('rid => '+rid);
                    // console.log('bid => '+bid);
                    // Initialize select2

                    // $("#warehouse").val(wid);
                    // $("#rack").val(rid);
                    // $("#bin").val(bid);
                // }, 10);
            });

            $("#myModal").on("show.bs.modal", function(e) {
                var link = $(e.relatedTarget);
                if(typeof link.attr("data-href") !== 'undefined') {
                    let pid = $('#pid').val();
                    let puid = $('#puid').val();
                    let pwid = $('#pwid').val();
                    let prid = $('#prid').val();
                    let pbid = $('#pbid').val();
                    let plid = $('#plid').val();
                    let pdid = $('#pdid').val();
                    let wid = $('#wid').val();
                    let wname = $('#wname').val();
                    let uid = $('#uid').val();
                    let uname = $('#uname').val();
                    let rid = $('#rid').val();
                    let rname = $('#rname').val();
                    let bid = $('#bid').val();
                    let bname = $('#bname').val();
                    let lid = $('#lid').val();
                    let lname = $('#lname').val();
                    console.log('pid => '+pid);
                    console.log('puid => '+puid);
                    console.log('pwid => '+pwid);
                    console.log('prid => '+prid);
                    console.log('pbid => '+pbid);
                    console.log('plid => '+plid);
                    console.log('pdid => '+pdid);
                    console.log('uid => '+uid);
                    console.log('wid => '+wid);
                    console.log('rid => '+rid);
                    console.log('bid => '+bid);
                    console.log('lid => '+lid);

                    $(this).find(".modal-body").load(link.attr("data-href")+'/'+pid+'/'+'/'+puid+'/'+pwid+'/'+'/'+prid+'/'+'/'+pbid+'/'+'/'+plid+'/'+'/'+pdid+'/');
                    setTimeout(function() {
                        $("#uom").select2({
                            theme: "bootstrap4 ",
                            ajax: {
                                url: "<?=site_url('uoms/getUoms')?>",
                                type: "post",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    // CSRF Hash
                                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                                    return {
                                    searchTerm: params.term, // search term
                                    page: params.page || 1,
                                    [csrfName]: csrfHash // CSRF Token
                                    };
                                },
                                processResults: function (response, params) {
                                    params.page = params.page || 1;

                                    // Update CSRF Token
                                    $('.txt_csrfname').val(response.token);

                                    return {
                                        results: response.data,
                                        pagination: {
                                            more: response.pagination.more
                                        }
                                    };
                                },
                                cache: true
                            }
                        });

                        // Fetch the preselected item, and add to the control
                        var uomSelect = $('#uom');
                        // create the option and append to Select2
                        var option = new Option(uname, uid, true, true);
                        uomSelect.append(option).trigger('change');

                        $("#label").select2({
                            multiple: true,
                            theme: "bootstrap4 ",
                            ajax: {
                                url: "<?=site_url('labels/getLabels')?>",
                                type: "post",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    // CSRF Hash
                                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                                    return {
                                    searchTerm: params.term, // search term
                                    page: params.page || 1,
                                    [csrfName]: csrfHash // CSRF Token
                                    };
                                },
                                processResults: function (response, params) {
                                    params.page = params.page || 1;

                                    // Update CSRF Token
                                    $('.txt_csrfname').val(response.token);

                                    return {
                                        results: response.data,
                                        pagination: {
                                            more: response.pagination.more
                                        }
                                    };
                                },
                                cache: true
                            }
                        });

                        // Fetch the preselected item, and add to the control
                        var labelSelect = $('#label');
                        var arrLname = lname.split(',');
                        var arrLid = lid.split('_');
                        var options = [];
                        // create the option and append to Select2
                        $(arrLname).each(function(k,v) {
                            options[k] = new Option(v, arrLid[k], true, true);
                        });
                        labelSelect.append(options).trigger('change');


                        $("#warehouse").select2({
                            theme: "bootstrap4 ",
                            // containerCssClass: 'custom-select',
                            ajax: {
                                url: "<?=site_url('warehouses/getWarehouses')?>",
                                type: "post",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    // CSRF Hash
                                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                                    return {
                                    searchTerm: params.term, // search term
                                    page: params.page || 1,
                                    [csrfName]: csrfHash // CSRF Token
                                    };
                                },
                                processResults: function (response, params) {
                                    params.page = params.page || 1;

                                    // Update CSRF Token
                                    $('.txt_csrfname').val(response.token);

                                    return {
                                        results: response.data,
                                        pagination: {
                                            // more: (params.page * 10) < data.count_filtered
                                            more: response.pagination.more
                                        }
                                    };
                                },
                                cache: true
                            }
                        });

                        // Fetch the preselected item, and add to the control
                        var warehouseSelect = $('#warehouse');
                        // create the option and append to Select2
                        var option = new Option(wname, wid, true, true);
                        warehouseSelect.append(option).trigger('change');


                        $("#rack").select2({
                            theme: "bootstrap4 ",
                            ajax: {
                                url: "<?=site_url('racks/getRacks')?>",
                                type: "post",
                                dataType: 'json',
                                delay: 50,
                                data: function (params) {
                                    // CSRF Hash
                                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                                    return {
                                    searchTerm: params.term, // search term
                                    page: params.page || 1,
                                    [csrfName]: csrfHash // CSRF Token
                                    };
                                },
                                processResults: function (response) {

                                    // Update CSRF Token
                                    $('.txt_csrfname').val(response.token);

                                    return {
                                        results: response.data,
                                        pagination: {
                                            more: response.pagination.more
                                        }
                                    };
                                },
                                cache: true
                            }
                        });

                        // Fetch the preselected item, and add to the control
                        var rackSelect = $('#rack');
                        // create the option and append to Select2
                        var option = new Option(rname, rid, true, true);
                        rackSelect.append(option).trigger('change');

                        $("#bin").select2({
                            theme: "bootstrap4",
                            ajax: {
                                url: "<?=site_url('bins/getBins')?>",
                                type: "post",
                                dataType: 'json',
                                delay: 50,
                                data: function (params) {
                                    // CSRF Hash
                                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                                    return {
                                    searchTerm: params.term, // search term
                                    page: params.page || 1,
                                    [csrfName]: csrfHash // CSRF Token
                                    };
                                },
                                processResults: function (response) {

                                    // Update CSRF Token
                                    $('.txt_csrfname').val(response.token);

                                    return {
                                        results: response.data,
                                        pagination: {
                                            more: response.pagination.more
                                        }
                                    };
                                },
                                cache: true
                            }
                        });

                        // Fetch the preselected item, and add to the control
                        var binSelect = $('#bin');
                        // create the option and append to Select2
                        var option = new Option(bname, bid, true, true);
                        binSelect.append(option).trigger('change');

                    }, 1000);
                }

            });

        });
    </script>
<?= $this->endSection() ?>
