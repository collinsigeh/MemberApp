<!-- addSubscriptionUserModal -->
<div class="modal fade" id="addSubscriptionUserModal" tabindex="-1" role="dialog" aria-labelledby="addSubscriptionUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubscriptionUserModalLabel">Add new subscription user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url().'subscriptions/add_subscription_user/'.$subscription->id); ?>
            <div class="form-group">
                <label for="email">Email of User to add</label>
                <input type="email" class="form-control" name="email" id="email" required />
                <small class="text-muted">*** Type the <b>email address</b> of the member to add ***</small>
            </div>
            <div class="form-group">
                <label for="confirm">Confirm action:</label>
                <input class="form-control" type="text" name="confirm" id="confirm" required />
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
<!-- End addSubscriptionUserModal -->