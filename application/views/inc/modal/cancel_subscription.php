<!-- cancelSubscriptionModal -->
<?php
    if($now < $subscription->subscription_end && $now > $subscription->subscription_start)
    {
        $status = '<span class="badge badge-pill badge-success">Active</span>';
    }
        elseif($now >= $subscription->subscription_end)
    {
        $status = '<span class="badge badge-pill badge-danger">Expired</span>';
    }
    else
    {
        $status = '<span class="badge badge-pill badge-info">Invalid</span>';
    }
?>
<div class="modal fade" id="cancelSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="cancelSubscriptionModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="cancelSubscriptionModalLabel">Cancel Subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Subscription:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $subscription->product_name; ?></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Status:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $status; ?></b>
                    </div>
                </div>
                <?php echo form_open(base_url().'subscriptions/cancel_subscription/'.$subscription->id); ?>
                    <div class="form-group">
                        <label for="confirm">Confirm action:</label>
                        <input class="form-control" type="text" name="confirm" id="confirm" required />
                        <small class="text-muted">*** Type <b>CANCEL</b> in the box above to confirm ***</small>
                    </div>
                    <div class="update-button">
                        <input type="submit" value="Submit" class="custom-outline-button">
                    </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
<!-- End cancelSubscriptionModal -->