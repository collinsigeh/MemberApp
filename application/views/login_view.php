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
            <div class="form-heading">Login</div>
            <div class="form-body">

                <?php echo form_open(base_url().'dashboard/loging_in/'); ?>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" required />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required />
                    </div>

                    <div class="text-center">
                        <input class="custom-outline-button" type="submit" name="submit" value="Login" />
                    </div>

                <?php form_close(); ?>
                
            </div>
          </div>
          <div class="alt-form-pages">
              <div class="form-option">
                Forgot your password? <a href="<?php echo base_url().'dashboard/reset_password'; ?>">Reset password</a>
              </div>
              <div class="form-option">
                Not yet a member? <a href="<?php echo base_url().'dashboard/register'; ?>">Register to Join NUSA</a>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>