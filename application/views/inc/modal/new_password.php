<!-- newPasswordModal -->
<div class="modal fade" id="newPasswordModal" tabindex="-1" role="dialog" aria-labelledby="newPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPasswordModalLabel">Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url().'dashboard/update_password/'); ?>
            <div class="form-group">
            <div class="row">
                <div class="col-md-5"><label for="password">New password</label></div>
                <div class="col-md-7">
                    <input type="password" name="password" id="password" class="form-control" required />
                </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row">
                <div class="col-md-5"><label for="confirm_password">Confirm password</label></div>
                <div class="col-md-7">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
                </div>
            </div>
            </div>

            <div class="update-button">
                <input type="submit" value="Save" class="custom-outline-button">
            </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- End NewPasswordModal -->