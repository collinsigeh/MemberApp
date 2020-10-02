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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'settings'; ?>">Settings</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().'settings/automated_emails'; ?>">Automated emails</a></li></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $automated_email->item; ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
            <?php echo $automated_email->item; ?>
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                      
                      <?php echo form_open(base_url().'settings/update_automated_email/'.$automated_email->id); ?>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="name">Name:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="name" id="name" value="<?php echo $automated_email->item; ?>" disabled />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="description">Description:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <textarea name="description" class="form-control" id="description" required><?php echo $automated_email->description; ?></textarea>
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="user_subject_line">User subject line:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="user_subject_line" id="user_subject_line" value="<?php echo $automated_email->user_subject_line; ?>" required />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="message_to_user">Message to user:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <textarea name="message_to_user" class="form-control" id="message_to_user" required><?php echo $automated_email->message_to_user; ?></textarea>
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="sender_name">Sender name:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="sender_name" id="sender_name" value="<?php echo $automated_email->sender_name; ?>" required />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="sender_email">Sender email:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="email" name="sender_email" id="sender_email" value="<?php echo $automated_email->sender_email; ?>" required />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="admin_subject_line">Admin subject line:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="admin_subject_line" id="admin_subject_line" value="<?php echo $automated_email->admin_subject_line; ?>" required />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="message_to_admin">Message to admin:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <textarea name="message_to_admin" class="form-control" id="message_to_admin" required><?php echo $automated_email->message_to_admin; ?></textarea>
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