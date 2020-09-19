<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="main-content">
          <!-- Main content -->
          <?php 
            include('inc/action_message.php');
          ?>
          <div class="form2">
            <div class="form2-title">New Registration</div>
            <div class="forms-body">

                <?php echo form_open(base_url().'dashboard/requesting_password_reset/'); ?>

                    <div class="form2-section">
                        <div class="form2-section-heading">Membership preference</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="account_type">Choose membership type</label>
                                <select class="form-control" name="account_type" id="account_type" required>
                                    <option value="Individual">Individual</option>
                                    <option value="Corporate">Corporate</option>
                                    <option value="Student">Student</option>
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
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Engr.">Engr.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Prof.">Prof.</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input class="form-control" type="text" name="firstname" id="firstname" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="surname">Surname</label>
                                        <input class="form-control" type="text" name="surname" id="surname" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" name="phone" id="phone" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Select your gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    
                    <div class="form2-section">
                        <div class="form2-section-heading">Professional information</div>
                        <div class="form2-section-body">
                            
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input class="form-control" type="text" name="designation" id="designation" required />
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                        <input class="custom-outline-button" type="submit" name="submit" value="Submit" />
                    </div>

                <?php form_close(); ?>
                
            </div>
          </div>
          <div class="alt-form-pages">
              <div class="form-option">
                <a href="<?php echo base_url().'dashboard/login'; ?>">Click here to login</a>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>