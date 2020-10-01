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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url().'settings'; ?>">Settings</a></li>
              <li class="breadcrumb-item active" aria-current="page">Application</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              Application Settings
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                      
                    <?php echo form_open(base_url().'settings/update/'); ?>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="admin_approval">Require Admin Approval for New Accounts:</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="admin_approval" id="" class="form-control" required>
                                        <option value="1" <?php if($settings->require_manual_approval_on_new_reg == 1){ echo 'selected'; } ?>>Yes</option>
                                        <option value="1" <?php if($settings->require_manual_approval_on_new_reg !== 1){ echo 'selected'; } ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Main Admin Email:</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" name="main_admin_email" id="email" value="<?php echo $settings->main_admin_email; ?>" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="admin_approval">Send Notification to Admin for New Accounts:</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="admin_approval" id="" class="form-control" required>
                                        <option value="1" <?php if($settings->send_admin_email_on_new_reg == 1){ echo 'selected'; } ?>>Yes</option>
                                        <option value="1" <?php if($settings->send_admin_email_on_new_reg !== 1){ echo 'selected'; } ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="admin_approval">Active Payment Processor:</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="admin_approval" id="" class="form-control" required>
                                        <option value="0">None</option>
                                        <?php
                                            foreach($payment_processors as $payment_processor)
                                            {
                                                echo '<option value="'.$payment_processor->id.'"';
                                                if($payment_processor->id == $settings->payment_processor_id)
                                                {
                                                    echo 'selected';
                                                }
                                                echo '>'.$payment_processor->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <input class="custom-outline-button" type="submit" name="submit" value="Save" />
                        </div>

                        <?php form_close(); ?>

                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          
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