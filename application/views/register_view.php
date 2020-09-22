<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="main-content">
          <!-- Main content -->
          <?php 
            include('inc/action_message.php');
          ?>
          <div class="form2">
            <div class="form2-title">New Registration</div>
            <div class="forms-body">

                <?php echo form_open(base_url().'dashboard/registering_user/'); ?>

                    <div class="form2-section">
                        <div class="form2-section-heading">Membership preference</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="membership">Choose membership type</label>
                                <select class="form-control" name="membership" id="membership" required>
                                    <option value="Individual" <?php if($this->session->membership == 'Individual'){ echo 'selected'; } ?>>Individual</option>
                                    <option value="Corporate" <?php if($this->session->membership == 'Corporate'){ echo 'selected'; } ?>>Corporate</option>
                                    <option value="Student" <?php if($this->session->membership == 'Student'){ echo 'selected'; } ?>>Student</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    
                    <div class="form2-section">
                        <div class="form2-section-heading">Personal details</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <select class="form-control" name="title" id="title" required>
                                    <option value="Mr." <?php if($this->session->title == 'Mr.'){ echo 'selected'; } ?>>Mr.</option>
                                    <option value="Mrs." <?php if($this->session->title == 'Mrs.'){ echo 'selected'; } ?>>Mrs.</option>
                                    <option value="Miss" <?php if($this->session->title == 'Miss'){ echo 'selected'; } ?>>Miss</option>
                                    <option value="Engr." <?php if($this->session->title == 'Engr.'){ echo 'selected'; } ?>>Engr.</option>
                                    <option value="Dr." <?php if($this->session->title == 'Dr.'){ echo 'selected'; } ?>>Dr.</option>
                                    <option value="Prof." <?php if($this->session->title == 'Prof.'){ echo 'selected'; } ?>>Prof.</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $this->session->firstname; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $this->session->lastname; ?>" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" value="<?php echo $this->session->email; ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo $this->session->phone; ?>" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Select your gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="Male" <?php if($this->session->gender == 'Male'){ echo 'selected'; } ?>>Male</option>
                                    <option value="Female" <?php if($this->session->gender == 'Female'){ echo 'selected'; } ?>>Female</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    
                    <div class="form2-section">
                        <div class="form2-section-heading">Member Status</div>
                        <div class="form2-section-body">
                            
                            <div class="form-group">
                                <label for="use_status">Best description of your work with unmanned systems (e.g. drones)</label>
                                <select class="form-control" name="use_status" id="use_status" required>
                                    <option value="">-- Select an option --</option>
                                    <option value="Regulator" <?php if($this->session->use_status == 'Regulator'){ echo 'selected'; } ?>>Regulator</option>
                                    <option value="Operator" <?php if($this->session->use_status == 'Operator'){ echo 'selected'; } ?>>Operator</option>
                                    <option value="Researcher" <?php if($this->session->use_status == 'Researcher'){ echo 'selected'; } ?>>Researcher</option>
                                    <option value="Recreational" <?php if($this->session->use_status == 'Recreational'){ echo 'selected'; } ?>>Recreational</option>
                                    <option value="Manufacturer" <?php if($this->session->use_status == 'Manufacturer'){ echo 'selected'; } ?>>Manufacturer</option>
                                    <option value="Marketer" <?php if($this->session->use_status == 'Marketer'){ echo 'selected'; } ?>>Marketer</option>
                                    <option value="Others" <?php if($this->session->use_status == 'Others'){ echo 'selected'; } ?>>Others</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="form_page" value="reg_page1">
                    
                    <div class="form2-progress">
                        <div class="row">
                            <div class="col-6">
                                <div class="stage">Page 1 of 2</div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <input class="custom-outline-button" type="submit" name="submit" value="Next" />
                                </div>
                            </div>
                        </div>
                    </div>

                <?php form_close(); ?>
                
            </div>
          </div>
      </div>
    </div>
  </div>
</div>