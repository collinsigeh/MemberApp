<!-- addSubscriptionModal -->
<div class="modal fade" id="addSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="addSubscriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubscriptionModalLabel">Add new subscription to member account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="member">Member:</label>
            <div class="alert alert-secondary">
                <b><?php echo $user->firstname.' '.$user->lastname.' ('.$user->email.')'; ?></b>
            </div>
        </div>
        <?php echo form_open(base_url().'subscriptions/add_to_user/'.$user->id); ?>
            <div class="form-group">
                <label for="subscriptions">Select subscription to add:</label>
                <?php
                  foreach ($subscription_products as $product) {
                    ?>
                    <div class="radio">
                        <input type="radio" name="subscription_product_id" id="subscription_product_id" value="<?php echo $product->id; ?>"> <label for="subscription_product_id"><?php echo $product->name; ?></label>
                    </div>
                    <?php
                  }
                ?>
            </div>
            <div class="form-group">
                <label for="start_date">Start date:</label>
                <input type="date" class="form-control" name="start_date" id="start_date" required />
            </div>
            <div class="form-group">
                <label for="end_date">End date:</label>
                <input type="date" class="form-control" name="end_date" id="end_date" required />
            </div>
            <div class="form-group">
                <label for="confirm">Confirm action:</label>
                <input class="form-control" type="text" name="confirm" id="confirm" placeholder="ADD" required />
                <small class="text-muted">*** Type <b>ADD</b> in the box above to confirm ***</small>
            </div>
            <div class="update-button">
                <input type="submit" value="Submit" class="custom-outline-button">
            </div>
            <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- End addSubscriptionModal -->