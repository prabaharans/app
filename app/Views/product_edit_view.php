
<?php echo form_open('product/update'); ?>
<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

<div class="form-row">
    <div class="form-group col-md-12">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" placeholder="productName" name="productName" value="<?= $product['name']; ?>" disabled>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="uom">UOM</label>
        <select name="uom" id="uom" class="custom-select"></select>
        <div class="-feedback"></div>
    </div>
    <div class="form-group col-md-12">
        <label for="productLabels">Product Labels</label>
        <input type="text" class="form-control" id="productLabels" placeholder="Product Labels" name="productLabels" value="<?= $label[0]['labels_name'] ?>" disabled>
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
        <input type="text" class="form-control" id="validationServer01" placeholder="Quantity" value="<?= $details['quantity'] ?>" required>
        <div class="-feedback"></div>
    </div>
</div>
<input type="hidden" name="pid" id="pid" value="<?= $product['id'] ?>" />
<input type="hidden" name="uid" id="uid" value="<?= $uom['uom_id'] ?>" />
<input type="hidden" name="uname" id="uname" value="<?= $uom['name'] ?>" />
<input type="hidden" name="wid" id="wid" value="<?= $warehouse['warehouse_id'] ?>" />
<input type="hidden" name="wname" id="wname" value="<?= $warehouse['name'] ?>" />
<input type="hidden" name="rid" id="rid" value="<?= $rack['rack_id'] ?>" />
<input type="hidden" name="rname" id="rname" value="<?= $rack['name'] ?>" />
<input type="hidden" name="bid" id="bid" value="<?= $bin['bin_id'] ?>" />
<input type="hidden" name="bname" id="bname" value="<?= $bin['name'] ?>" />
<input type="hidden" name="lid" id="lid" value="<?= $label[0]['label_id'] ?>" />
<input type="hidden" name="lname" id="lname" value="<?= $label[0]['labels_name'] ?>" />
<input type="hidden" name="puid" id="puid" value="<?= $uom['id'] ?>" />
<input type="hidden" name="pwid" id="pwid" value="<?= $warehouse['id'] ?>" />
<input type="hidden" name="prid" id="prid" value="<?= $rack['id'] ?>" />
<input type="hidden" name="pbid" id="pbid" value="<?= $bin['id'] ?>" />
<input type="hidden" name="plid" id="plid" value="<?= $label[0]['plid'] ?>" />
<input type="hidden" name="pdid" id="pdid" value="<?= $details['id'] ?>" />
<button type="submit" class="btn btn-primary">Update</button>

<?php echo form_close(); ?>
