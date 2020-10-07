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
            
            <?php
            if($user->membership == 'Student')
            {
            ?>
            <div class="dashboard-section">
              <div class="section-heading">
                  Student professional info
              </div>
              <div class="section-body">
                <div class="section-item">
  
                    <div class="form3">


                      <div class="row">
                          <div class="col-md-3">
                              <label for="institution">Institution</label>
                          </div>
                          <div class="col-md-9">
                              <div class="form-group">
                                <input class="form-control" type="text" name="institution" id="institution" value="<?php if(isset($student_info->institution)){ echo $student_info->institution; } ?>" />
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-3">
                              <label for="course_of_study">Course of Study</label>
                          </div>
                          <div class="col-md-9">
                              <div class="form-group">
                                <input class="form-control" type="text" name="course_of_study" id="course_of_study" value="<?php if(isset($student_info->course_of_study)){ echo $student_info->course_of_study; } ?>" />
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-3">
                              <label for="degree">Degree of Study</label>
                          </div>
                          <div class="col-md-9">
                              <div class="form-group">
                                <select class="form-control" name="degree" id="degree">
                                    <option value="">-- Select appropriate degree --</option>
                                    <option value="B.Sc" <?php if(isset($student_info->degree) && $student_info->degree == 'B.Sc'){ echo 'selected'; } ?>>B.Sc</option>
                                    <option value="Diploma" <?php if(isset($student_info->degree) && $student_info->degree == 'Diploma'){ echo 'selected'; } ?>>Diploma</option>
                                    <option value="Masters" <?php if(isset($student_info->degree) && $student_info->degree == 'Masters'){ echo 'selected'; } ?>>Masters</option>
                                    <option value="PhD" <?php if(isset($student_info->degree) && $student_info->degree == 'PhD'){ echo 'selected'; } ?>>PhD</option>
                                    <option value="Professional Certification" <?php if(isset($student_info->degree) && $student_info->degree == 'Professional Certification'){ echo 'selected'; } ?>>Professional Certification</option>
                                    <option value="School Certificate" <?php if(isset($student_info->degree) && $student_info->degree == 'School Certificate'){ echo 'selected'; } ?>>School Certificate</option>
                                    <option value="Others" <?php if(isset($student_info->degree) && $student_info->degree == 'Others'){ echo 'selected'; } ?>>Others</option>
                                </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-3">
                              <label for="graduation_year">Graduation Year</label>
                          </div>
                          <div class="col-md-9">
                              <div class="form-group">
                                <input class="form-control" type="text" name="graduation_year" id="graduation_year" value="<?php if(isset($student_info->graduation_year)){ echo $student_info->graduation_year; } ?>" />
                              </div>
                          </div>
                      </div>


                    </div>

                </div>
              </div>
            </div>
        <?php
        }
        else
        {
        ?>
        <div class="dashboard-section">
          <div class="section-heading">
              Professional info
          </div>
          <div class="section-body">
            <div class="section-item">

                <div class="form3">

                  <div class="row">
                      <div class="col-md-3">
                          <label for="organisation">Organisation / Company</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <input class="form-control" type="text" name="organisation" id="organisation" value="<?php if(isset($professional_info->organisation)){ echo $professional_info->organisation; } ?>" />
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                          <label for="industry">Industry</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <select class="form-control" name="industry" id="industry">
                                    <option value="">-- Select an industry --</option>
                                    <option value="Agriculture" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Agriculture'){ echo 'selected'; } ?>>Agriculture</option>
                                    <option value="Construction & Real Estate" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Construction & Real Estate'){ echo 'selected'; } ?>>Construction & Real Estate</option>
                                    <option value="Consumer Goods Manufacturing" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Consumer Goods Manufacturing'){ echo 'selected'; } ?>>Consumer Goods Manufacturing</option>
                                    <option value="Financial Services" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Financial Services'){ echo 'selected'; } ?>>Financial Services</option>
                                    <option value="Healthcare" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Healthcare'){ echo 'selected'; } ?>>Healthcare</option>
                                    <option value="Industrial Goods Manufacturing" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Industrial Goods Manufacturing'){ echo 'selected'; } ?>>Industrial Goods Manufacturing</option>
                                    <option value="Information & Communications Technology" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Information & Communications Technology'){ echo 'selected'; } ?>>Information & Communications Technology</option>
                                    <option value="Natural Resources (Mining & Mineral Extraction)" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Natural Resources (Mining & Mineral Extraction)'){ echo 'selected'; } ?>>Natural Resources (Mining & Mineral Extraction)</option>
                                    <option value="Oil & Gas" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Oil & Gas'){ echo 'selected'; } ?>>Oil & Gas</option>
                                    <option value="Services" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Services'){ echo 'selected'; } ?>>Services</option>
                                    <option value="Utilities (Electricity, Water, etc.)" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Utilities (Electricity, Water, etc.)'){ echo 'selected'; } ?>>Utilities (Electricity, Water, etc.)</option>
                                    <option value="Conglomerate" <?php if(isset($professional_info->industry) && $professional_info->industry == 'Conglomerate'){ echo 'selected'; } ?>>Conglomerate</option>
                                </select>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                          <label for="organisation_description">Description of organisation</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <textarea class="form-control" name="organisation_description" id="organisation_description"><?php if(isset($professional_info->organisation_description)){ echo $professional_info->organisation_description; } ?></textarea>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                          <label for="office_address">Office address</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <input class="form-control" type="text" name="office_address" id="office_address" value="<?php if(isset($professional_info->office_address)){ echo $professional_info->office_address; } ?>" />
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                          <label for="designation">Designation</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <input class="form-control" type="text" name="designation" id="designation" value="<?php if(isset($professional_info->designation)){ echo $professional_info->designation; } ?>" />
                          </div>
                      </div>
                  </div>

                </div>

            </div>
          </div>
        </div>
        <?php
        }
        if($user->use_status == 'Operator')
        {
        ?>
        <div class="dashboard-section">
          <div class="section-heading">
              Authorization details
          </div>
          <div class="section-body">
            <div class="section-item">

                <div class="form3">

                  <div class="row">
                      <div class="col-md-3">
                            <label for="ncaa_roc_number">NCAA ROC Number</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <input class="form-control" type="text" name="ncaa_roc_number" id="ncaa_roc_number" value="<?php if(isset($authorization_detail->ncaa_roc_number)){ echo $authorization_detail->ncaa_roc_number; } ?>" />
                                <span class="small text-muted">*** If not available, state your status ***</span>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                            <label for="class_of_operations">Class of Operations</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <div class="checkbox">
                                    <input type="checkbox" name="vlos" id="vlos" value="1" <?php if(isset($authorization_detail->vlos_class_of_operation) && $authorization_detail->vlos_class_of_operation == 1){ echo 'checked'; } ?>> <label for="vlos">VLOS (Visual Line of Sight)</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="bvlos" id="bvlos" value="1" <?php if(isset($authorization_detail->bvlos_class_of_operation) && $authorization_detail->bvlos_class_of_operation == 1){ echo 'checked'; } ?>> <label for="bvlos">BVLOS (Beyond Visual Line of Sight)</label>
                                </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-3">
                            <label for="approved_operations">Approved Operations</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <div class="radio">
                                    <input type="radio" name="approved_operation" id="commercial" value="Commercial" <?php if(isset($authorization_detail->approved_operation) && $authorization_detail->approved_operation == 'Commercial'){ echo 'checked'; } ?> required /> <label for="commercial">Commercial</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="approved_operation" id="government" value="Government" <?php if(isset($authorization_detail->approved_operation) && $authorization_detail->approved_operation == 'Government'){ echo 'checked'; } ?> required /> <label for="government">Government</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="approved_operation" id="corporate" value="Corporate" <?php if(isset($authorization_detail->approved_operation) && $authorization_detail->approved_operation == 'Corporate'){ echo 'checked'; } ?> required /> <label for="corporate">Corporate</label>
                                </div>
                          </div>
                      </div>
                  </div>

                </div>

            </div>
          </div>
        </div>
        <?php
        }
        elseif($user->use_status == 'Recreational')
        {
        ?>
        <div class="dashboard-section">
          <div class="section-heading">
              Additional details
          </div>
          <div class="section-body">
            <div class="section-item">

                <div class="form3">

                  <div class="row">
                      <div class="col-md-3">
                            <label for="home_address">Home Address</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <input class="form-control" type="text" name="home_address" id="home_address" value="<?php if(isset($authorization_detail->home_address)){ echo $authorization_detail->home_address; } ?>" />
                          </div>
                      </div>
                  </div>

                  <!-- START TEMPORARILY REMOVED

                  <div class="row">
                      <div class="col-md-3">
                            <label for="ncaa_roc_number">NCAA Registration Number</label>
                      </div>
                      <div class="col-md-9">
                          <div class="form-group">
                                <input class="form-control" type="text" name="ncaa_roc_number" id="ncaa_roc_number" value="<?php // if(isset($authorization_detail->ncaa_roc_number)){ echo $authorization_detail->ncaa_roc_number; } ?>" />
                                <span class="small text-muted">*** If not available, state your status ***</span>
                          </div>
                      </div>
                  </div>

                  END TEMPORARILY REMOVED -->

                </div>

            </div>
          </div>
        </div>
        <?php
        }
        ?>
          
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