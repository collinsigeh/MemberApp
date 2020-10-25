<!-- renewSubscriptionModal -->
        <div class="modal fade" id="renewSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="renewSubscriptionModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="renewSubscriptionModalLabel">Renew subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Subscription package:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $subscription->product_name; ?></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">User limit:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $item_detail->user_limit; ?></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Validity:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $item_detail->duration.' days'; ?></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Price:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $product->currency_symbol.' '.$product->amount; ?></b>
                    </div>
                </div>
                <?php echo form_open(base_url().'subscriptions/renew_subscription/'.$subscription->id); ?>
                    <div class="update-button">
                        <input type="submit" value="Submit" class="custom-outline-button">
                    </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
<!-- End renewSubscriptionModal -->