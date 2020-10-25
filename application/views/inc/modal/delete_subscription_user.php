<!-- deleteSubscriptionUserModal -->
<?php
    foreach ($subscription_users as $subscription_user) {
        ?>
        <div class="modal fade" id="deleteSubscriptionUser<?php echo $subscription_user->id; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="deleteSubscriptionUser<?php echo $subscription_user->id; ?>ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteSubscriptionUser<?php echo $subscription_user->id; ?>ModalLabel">Delete subscription user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Subscription user:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $subscription_user->firstname.' '.$subscription_user->lastname.' ('.$subscription_user->email.')'; ?></b>
                    </div>
                </div>
                <?php echo form_open(base_url().'subscriptions/delete_subscription_user/'.$subscription_user->id); ?>
                    <input type="hidden" name="subscription_code" value="<?php echo $subscription->subscription_code; ?>" required>
                    <div class="form-group">
                        <label for="confirm">Confirm action:</label>
                        <input class="form-control" type="text" name="confirm" id="confirm" required />
                        <small class="text-muted">*** Type <b>DELETE</b> in the box above to confirm ***</small>
                    </div>
                    <div class="update-button">
                        <input type="submit" value="Submit" class="custom-outline-button">
                    </div>
                    <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
?>
<!-- End deleteSubscriptionUserModal -->