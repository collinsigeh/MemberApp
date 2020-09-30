<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="main-content">
          <!-- Main content -->
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="form2">
            <div class="form2-title">New Registration (Cont.)</div>
            <div class="forms-body">

                <?php echo form_open(base_url().'dashboard/registering_user/'); ?>
                    
                    <!-- Student or Professional detail -->
                    <?php
                        if($this->session->membership == 'Student')
                        {
                            $this->load->view('inc/reg_page2_student_info');
                        }
                        else
                        {
                            $this->load->view('inc/reg_page2_professional_info');
                        }
                    ?>

                    <!-- Authorization detail for each use_staaus -->
                    <?php
                        if($this->session->use_status == 'Operator')
                        {
                            $this->load->view('inc/reg_page2_operator_authorization');
                        }
                        elseif($this->session->use_status == 'Recreational')
                        {
                            // suspended for now
                            $this->load->view('inc/reg_page2_recreational_authorization');
                        }
                    ?>
                    
                    <div class="form2-section">
                        <div class="form2-section-heading">Member Account Access</div>
                        <div class="form2-section-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" value="<?php echo $this->session->password; ?>" required />
                                        <small class="text-muted">*** Type the password to lock your account ***</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" value="<?php echo $this->session->confirm_password; ?>" required />
                                        <small class="text-muted">*** Re-type password to confirm ***</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form2-section">
                        <div class="form2-section-heading">NUSA Code of Conduct</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label class="consent_detail" for="NUSA_code_of_conduct">
                                    <div class="alert alert-outline-light">
                                    I hereby acknowledge that I have read and understand the Nigeria Unmanned Systems & Robotics 
                                    Association's (NUSA) Code of Conduct and will be responsible for obtaining all future amendments 
                                    and modifications thereto. I further acknowledge that I have read and understand all of my 
                                    obligations, duties, and responsibilities under each principle and provision of the NUSA Code of 
                                    Conduct and constitution and will read and understand all of my obligations, duties and 
                                    responsibilities under all future amendments and modifications thereto. I understand that violations 
                                    of the Code of Conduct or NUSA policies may result in disciplinary action including suspension and/or 
                                    withdrawal of my membership. I certify that this is a true and correct statement by me.</div>
                                </label>
                                <div class="checkbox">
                                    <input type="checkbox" name="code_of_conduct" id="code_of_conduct" value="1" <?php if($this->session->code_of_conduct == 1){ echo 'checked'; } ?>> <label for="code_of_conduct">I agree.</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form2-section">
                        <div class="form2-section-heading">Terms and Conditions</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label class="consent_detail" for="NUSA_terms_and_conditions">
                                    <div class="alert alert-outline-light">
                                    I affirm that all information provided are correct. I understand that my completion of this form 
                                    authorizes the association to make use of the information for the business of the association, and as 
                                    may be required by the relevant authorities under the Nigerian Law, if the need arises.</div>
                                </label>
                                <div class="checkbox">
                                    <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" value="1" <?php if($this->session->terms_and_conditions == 1){ echo 'checked'; } ?>> <label for="terms_and_conditions">I agree.</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="form_page" value="reg_page2.2">
                    
                    <div class="form2-progress">
                        <div class="row">
                            <div class="col-7">
                                <div class="stage">Page 2 of 2 <a href="<?php echo base_url().'dashboard/register/'; ?>" class="btn btn-sm btn-outline-secondary">Back to page 1</a></div>
                            </div>
                            <div class="col-5">
                                <div class="text-right">
                                    <input class="custom-outline-button" type="submit" name="submit" value="Submit" />
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