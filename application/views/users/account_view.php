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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'users'; ?>">User accounts</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $user->firstname.' '.$user->lastname; ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <?php echo form_open(base_url().'users/update_account/'.$user->id); ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Account setting
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="user_type">User type</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select class="form-control" name="user_type" id="user_type" required>
                                    <option value="Admin" <?php if($user->user_type == 'Admin'){ echo 'selected'; } ?>>Admin</option>
                                    <option value="Member" <?php if($user->user_type == 'Member'){ echo 'selected'; } ?>>Member</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="membership">Membership</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select class="form-control" name="membership" id="membership" required>
                                    <option value="Individual" <?php if($user->membership == 'Individual'){ echo 'selected'; } ?>>Individual</option>
                                    <option value="Corporate" <?php if($user->membership == 'Corporate'){ echo 'selected'; } ?>>Corporate</option>
                                    <option value="Student" <?php if($user->membership == 'Student'){ echo 'selected'; } ?>>Student</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="use_status">Member status</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select class="form-control" name="use_status" id="use_status" required>
                                    <option value="">-- Select an option --</option>
                                    <option value="Regulator" <?php if($user->use_status == 'Regulator'){ echo 'selected'; } ?>>Regulator</option>
                                    <option value="Operator" <?php if($user->use_status == 'Operator'){ echo 'selected'; } ?>>Operator</option>
                                    <option value="Researcher" <?php if($user->use_status == 'Researcher'){ echo 'selected'; } ?>>Researcher</option>
                                    <option value="Recreational" <?php if($user->use_status == 'Recreational'){ echo 'selected'; } ?>>Recreational</option>
                                    <option value="Manufacturer" <?php if($user->use_status == 'Manufacturer'){ echo 'selected'; } ?>>Manufacturer</option>
                                    <option value="Marketer" <?php if($user->use_status == 'Marketer'){ echo 'selected'; } ?>>Marketer</option>
                                    <option value="Others" <?php if($user->use_status == 'Others'){ echo 'selected'; } ?>>Others</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="status">Account status</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select class="form-control" name="status" id="status" required>
                                    <option value="Mr." <?php if($user->status == 'Active'){ echo 'selected'; } ?>>Active</option>
                                    <option value="Mr." <?php if($user->status == 'Pending Approval'){ echo 'selected'; } ?>>Pending Approval</option>
                                    <option value="Mr." <?php if($user->status == 'Suspended'){ echo 'selected'; } ?>>Suspended</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="subcription">Subscription(s)</label>
                        </div>
                        <div class="col-md-9">
                            <?php 
                                echo $no_subscriptions.' found.';
                                if($no_subscriptions == 0)
                                {
                                    echo ' <a href="'.base_url().'users/subscriptions/'.$user->id.'" class="btn btn-sm btn-outline-secondary">View details</a>';
                                }
                            ?>
                            
                        </div>
                    </div>

                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

            <div class="dashboard-section">
            <div class="section-heading">
                Personal details
            </div>
            <div class="section-body">
                <div class="section-item">
                <div class="row">
                    <div class="col-12">

                    <div class="form3">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <select class="form-control" name="title" id="title" required>
                                <option value="Mr." <?php if($user->title == 'Mr.'){ echo 'selected'; } ?>>Mr.</option>
                                <option value="Mrs." <?php if($user->title == 'Mrs.'){ echo 'selected'; } ?>>Mrs.</option>
                                <option value="Miss" <?php if($user->title == 'Miss'){ echo 'selected'; } ?>>Miss</option>
                                <option value="Engr." <?php if($user->title == 'Engr.'){ echo 'selected'; } ?>>Engr.</option>
                                <option value="Dr." <?php if($user->title == 'Dr.'){ echo 'selected'; } ?>>Dr.</option>
                                <option value="Prof." <?php if($user->title == 'Prof.'){ echo 'selected'; } ?>>Prof.</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $user->firstname; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $user->lastname; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $user->email; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo $user->phone; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender">Select your gender</label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value="Male" <?php if($user->gender == 'Male'){ echo 'selected'; } ?>>Male</option>
                                <option value="Female" <?php if($user->gender == 'Female'){ echo 'selected'; } ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    </div>
                </div>
                </div>
            </div>
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