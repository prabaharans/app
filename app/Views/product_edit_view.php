<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" integrity="sha512-z/90a5SWiu4MWVelb5+ny7sAayYUfMmdXKEAbpj27PfdkamNdyI3hcjxPxkOPbrXoKIm7r9V2mElt5f1OtVhqA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php echo form_open('product/update'); ?>
<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" placeholder="productName" name="productName" value="" disabled>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="uom">UOM</label>
        <input type="text" class="form-control" id="uom" placeholder="UOM" name="uom" value="" disabled>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="warehouse">Warehouse</label>
        <select name="warehouse" id="warehouse" class="custom-select"></select>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="rack">Rack</label>
        <select name="rack" id="rack" class="custom-select"></select>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="bin">Bin</label>
        <select name="bin" id="bin" class="custom-select"></select>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="validationServer01">Quantity</label>
        <input type="text" class="form-control" id="validationServer01" placeholder="Quantity" value="" required>
        <div class="-feedback"></div>
    </div>
</div>
<input type="hidden" name="pid" id="pid" value="" />
<input type="hidden" name="pwid" id="pwid" value="" />
<input type="hidden" name="prid" id="prid" value="" />
<input type="hidden" name="pbid" id="pbid" value="" />
<button type="submit" class="btn btn-primary">Update</button>

<?php echo form_close(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>
    $(document).ready(function(){

        // Initialize select2
        $("#warehouse").select2({
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
                    [csrfName]: csrfHash // CSRF Token
                    };
                },
                processResults: function (response) {

                    // Update CSRF Token
                    $('.txt_csrfname').val(response.token);

                    return {
                        results: response.data
                    };
                },
                cache: true
            }
        });

    });
</script>