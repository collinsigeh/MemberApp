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
                                        <label for="firstname">First Name</label>
                                        <input class="form-control" type="text" name="firstname" id="firstname" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="surname">Last Name</label>
                                        <input class="form-control" type="text" name="lastname" id="lastname" required />
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
                        <div class="form2-section-heading">Member Status</div>
                        <div class="form2-section-body">
                            
                            <div class="form-group">
                                <label for="status">Best description of your work with unmanned systems (e.g. drones)</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="">-- Select an option --</option>
                                    <option value="Regulator">Regulator</option>
                                    <option value="Operator">Operator</option>
                                    <option value="Researcher">Researcher</option>
                                    <option value="Recreational">Recreational</option>
                                    <option value="Manufacturer">Manufacturer</option>
                                    <option value="Marketer">Marketer</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="page" value="page1">
                    
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