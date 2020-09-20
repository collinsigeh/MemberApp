<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="main-content">
          <!-- Main content -->
          <?php 
            include('inc/action_message.php');
          ?>
          <div class="form">
            <div class="form-heading">Reset password</div>
            <div class="form-body">

                <?php echo form_open(base_url().'dashboard/requesting_password_reset/'); ?>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required />
                    </div>

                    <div class="text-center">
                        <input class="custom-outline-button" type="submit" name="submit" value="Submit" />
                    </div>

                <?php form_close(); ?>
                
            </div>
          </div>
          <div class="alt-form-pages">
              <div class="form-option">
                <a href="<?php echo base_url().'dashboard/login'; ?>"><< Back to login</a>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>