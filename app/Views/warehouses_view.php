
    <?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>Warehouse <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <?= $this->include(config('Auth')->views['menu_layout']) ?>
    <div class="container">
        <div class="card col-12 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5">Warehouse</h5>
                <table id="table" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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
                    ajax: '<?php echo site_url('warehouses/ajaxWareHouseDataTables'); ?>'
                });
            });
        });
    </script>
<?= $this->endSection() ?>
