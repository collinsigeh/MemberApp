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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'settings/payment_processors'; ?>">Payment processors</a></li></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $payment_processor->name; ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
            <?php echo $payment_processor->name; ?> details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                      
                      <?php echo form_open('#'); ?>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="name">Name:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="name" id="name" value="<?php echo $payment_processor->name; ?>" disabled />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="merchant_number">Merchant number:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="merchant_number" id="merchant_number" value="<?php echo $payment_processor->merchant_number; ?>" disabled />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="secret_key">Secret key:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="password" name="secret_key" id="secret_key" value="<?php echo $payment_processor->secret_key; ?>" disabled />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="public_key">Public key:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="public_key" id="public_key" value="<?php echo $payment_processor->public_key; ?>" disabled />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="currency">Currency:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="currency" id="currency" value="<?php echo $payment_processor->currency; ?>" disabled />
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="currency_symbol">Currency symbol:</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input class="form-control" type="text" name="currency_symbol" id="currency_symbol" value="<?php echo $payment_processor->currency_symbol; ?>" disabled />
                                  </div>
                              </div>
                          </div>
                          
                          <!--
                          <div class="text-center">
                              <input class="custom-outline-button" type="submit" name="submit" value="Save" />
                          </div>
                          -->
  
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