<!-- newProductModal -->
<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newProductModalLabel">New product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <small>
            <div class="alert alert-info">Select the type of product you wish to create and click continue.</div>
        </small>
        <?php echo form_open(base_url().'products/create/'); ?>
            <div class="form-group">
                <label for="product_type">Product Type</label>
                <select name="product_type" id="product_type" class="form-control" require>
                    <option value="">-- Select an option --</option>
                    <option value="Non-subscription">Non-subscription</option>
                    <option value="Subscription">Subscription</option>
                </select>
            </div>
            <div class="text-center" style="padding-top: 25px;">
                <input type="submit" value="Continue" class="custom-outline-button">
            </div>
            <?php form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- End NewProductModal -->