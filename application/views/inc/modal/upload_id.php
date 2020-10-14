<!-- uploadIDModal -->
<div class="modal fade" id="uploadIDModal" tabindex="-1" role="dialog" aria-labelledby="uploadIDModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadIDModalLabel">Update valid ID</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart(base_url().'dashboard/upload_id/'); ?>
            <div class="form-group">
                <label for="password">Select ID to upload</label>
                <input type="file" name="userfile"class="form-control" required />
                <small class="text-muted"><b>Allowed formats:</b> .gif, .jpg, .jpeg and .png<br/><b>Max size:</b> 2MB</small>
            </div>

            <div class="update-button">
                <input type="submit" value="Save" class="custom-outline-button">
            </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- End uploadIDModal -->