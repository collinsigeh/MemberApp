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
                <div class="radio">
                    <input type="radio" name="subscription_id" id="subscription_id" value="sub id"> <label for="subscription_id">Sub name</label>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm">Confirm Action:</label>
                <input class="form-control" type="text" name="confirm" id="confirm" placeholder="ADD" required />
                <small class="text-muted">*** Type <b>ADD</b> in the box above to confirm ***</small>
            </div>
            <div class="update-button">
                <input type="submit" value="Submit" class="custom-outline-button">
            </div>
            <?php form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- End addSubscriptionModal -->