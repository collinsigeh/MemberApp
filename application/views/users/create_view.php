<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-8">
        <div class="main-content">
          <!-- Main content -->
          <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><img src="<?php echo base_url().'assets/img/icon_images/homepage_icon.png'; ?>" alt="Dashboard" class="homepage-icon" ></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().'users/'; ?>">User accounts</a></li>
              <li class="breadcrumb-item active" aria-current="page">New admin</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <?php echo form_open(base_url().'users/save_admin/'); ?>

          <div class="dashboard-section">
            <div class="section-heading">
                New admin details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                      <div class="form3">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <select class="form-control" name="title" id="title" required>
                                    <option value="Mr." <?php if($this->session->user_title == 'Mr.'){ echo 'selected'; } ?>>Mr.</option>
                                    <option value="Mrs." <?php if($this->session->user_title == 'Mrs.'){ echo 'selected'; } ?>>Mrs.</option>
                                    <option value="Miss" <?php if($this->session->user_title == 'Miss'){ echo 'selected'; } ?>>Miss</option>
                                    <option value="Engr." <?php if($this->session->user_title == 'Engr.'){ echo 'selected'; } ?>>Engr.</option>
                                    <option value="Dr." <?php if($this->session->user_title == 'Dr.'){ echo 'selected'; } ?>>Dr.</option>
                                    <option value="Prof." <?php if($this->session->user_title == 'Prof.'){ echo 'selected'; } ?>>Prof.</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $this->session->user_firstname; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $this->session->user_lastname; ?>" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" value="<?php echo $this->session->user_email; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo $this->session->user_phone; ?>" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Select your gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="Male" <?php if($this->session->user_gender == 'Male'){ echo 'selected'; } ?>>Male</option>
                                    <option value="Female" <?php if($this->session->user_gender == 'Female'){ echo 'selected'; } ?>>Female</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" value="<?php echo $this->session->user_password; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" value="<?php echo $this->session->user_confirm_password; ?>" required />
                                        <small class="text-muted">*** Re-type password to confirm ***</small>
                                    </div>
                                </div>
                            </div>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="update-button">
            <input class="custom-outline-button" type="submit" name="submit" value="Save" />
          </div>

          <?php form_close(); ?>

        </div>

      </div>

      <div class="col-md-4">
        <div class="sidebar">
          <!-- Sidebar -->
          <?php
            $this->load->view('inc/admin_sidebar'); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>