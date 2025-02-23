<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>Product Details <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <?= $this->include(config('Auth')->views['menu_layout']) ?>
    <div class="container">

        <div class="card col-12 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5">Product Details</h5>
                <table id="table" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>UOM</th>
                            <th>WareHouse</th>
                            <th>Rack</th>
                            <th>Bin</th>
                            <th>Product Labels</th>
                            <th>Quantity</th>
                            <th>Status</th>
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
        var flag = 1;
        document.addEventListener("DOMContentLoaded", (event) => {

            $(document).ready(function() {
                $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '<?php echo site_url('product-details/ajaxProductDetailsDataTables'); ?>',
                    order: [],
                    columns: [
                        {data: 'no', orderable: false},
                        {data: 'name'},
                        {data: 'uoms_name'},
                        {data: 'warehouses_name'},
                        {data: 'racks_name'},
                        {data: 'bins_name'},
                        {data: 'labels_name'},
                        {data: 'quantity'},
                        {data: 'status'},
                        {data: 'action', orderable: false},
                    ],
                    rowCallback: function(row, data, index){
                        // $(row).find('.edit').on('click', function(e) {
                            // flag = 1;
                        //     e.stopImmediatePropagation();
                        //     let pid = $(this).attr('data-pid');
                        //     let puid = $(this).attr('data-puid');
                        //     let pwid = $(this).attr('data-pwid');
                        //     let prid = $(this).attr('data-prid');
                        //     let pbid = $(this).attr('data-pbid');
                        //     let plid = $(this).attr('data-plid');
                        //     let pdid = $(this).attr('data-pdid');
                        //     console.log('rowCallback => start');
                        //     console.log('pid => '+pid);
                        //     console.log('puid => '+puid);
                        //     console.log('pwid => '+pwid);
                        //     console.log('prid => '+prid);
                        //     console.log('pbid => '+pbid);
                        //     console.log('plid => '+plid);
                        //     console.log('pdid => '+pdid);
                        //     $('#pid').val(pid);
                        //     $('#puid').val(puid);
                        //     $('#pwid').val(pwid);
                        //     $('#prid').val(prid);
                        //     $('#pbid').val(pbid);
                        //     $('#plid').val(plid);
                        //     $('#pdid').val(pdid);

                        //     // setTimeout(function() {
                        //         $('#myModalLabel').text('Edit');
                        //         $('#myModal').modal('show');
                        //     // }, 10);
                        //     console.log('rowCallback => End');
                        // });
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
            // $("#myModal").on('hide.bs.modal', function () {
            //     $("#myModal").off();
            // });
            // $("#myModal").on('hidden.bs.modal', function () {
            //     $("#myModal").off();
            // });


        });
        console.log('test => 2 ');
        // $('#table').on('click', 'td.edit button', function (e) {
        //     console.log('flag => '+flag);
        //     flag = 1;
        //     console.log('flag => '+flag);
        //     // e.stopImmediatePropagation();
        // });

        $("#myModal").on("hide.bs.modal", function(e) {
            // console.log('flag => '+flag);
            flag = 1;
            // console.log('flag => '+flag);
        });
        $("#myModal").on("show.bs.modal", function(e) {

            if(flag == 0) {
                // console.log('test => 1 ');
                // e.stopImmediatePropagation();
                // $(this).off('shown.bs.modal');
                $('#myModalLabel').text('Edit');
                var link = $(e.relatedTarget);
                if(typeof link.attr("data-href") !== 'undefined') {
                    let pid = link.attr('data-pid');
                    let puid = link.attr('data-puid');
                    let pwid = link.attr('data-pwid');
                    let prid = link.attr('data-prid');
                    let pbid = link.attr('data-pbid');
                    let plid = link.attr('data-plid');
                    let pdid = link.attr('data-pdid');
                    let wid = link.attr('data-wid');
                    let wname = link.attr('data-wname');
                    let uid = link.attr('data-uid');
                    let uname = link.attr('data-uname');
                    let rid = link.attr('data-rid');
                    let rname = link.attr('data-rname');
                    let bid = link.attr('data-bid');
                    let bname = link.attr('data-bname');
                    let lid = link.attr('data-lid');
                    let lname = link.attr('data-lname');
                    console.log('lname => '+lname);
                    // console.log('pid => '+pid);
                    // console.log('puid => '+puid);
                    // console.log('pwid => '+pwid);
                    // console.log('prid => '+prid);
                    // console.log('pbid => '+pbid);
                    // console.log('plid => '+plid);
                    // console.log('pdid => '+pdid);
                    // console.log('uid => '+uid);
                    // console.log('wid => '+wid);
                    // console.log('rid => '+rid);
                    // console.log('bid => '+bid);
                    // console.log('lid => '+lid);

                    $(this).find(".modal-body").load(link.attr("data-href"));

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
                            console.log('v => '+v);
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

            }
            flag = 0;

        });
    </script>
<?= $this->endSection() ?>
