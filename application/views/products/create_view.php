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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'products/'; ?>">Products</a></li>
              <li class="breadcrumb-item active" aria-current="page">New product</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <?php echo form_open(base_url().'products/save/'); ?>

          <div class="dashboard-section">
            <div class="section-heading">
                New product details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                      <div class="form3">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="product_type">Product type</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="hidden" name="product_type" value="<?php echo $product_type; ?>" required />
                                        <input type="text" class="form-control" name="v_product_type" value="<?php echo $product_type; ?>" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name">Product name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $this->session->product_name; ?>" required />
                                        <small class="text-muted">*** Be as descriptive as possible. Example: <b>NUSA Magazine vol. 10</b> ***</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="created_for">Created for</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <input type="checkbox" name="for_individual" id="for_individual" value="1" <?php if($this->session->product_for_individual == 1){ echo 'checked'; } ?> /> <label for="for_individual">Individual members</label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="for_corporate" id="for_corporate" value="1" <?php if($this->session->product_for_corporate == 1){ echo 'checked'; } ?> /> <label for="for_corporate">Corporate members</label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="for_student" id="for_student" value="1" <?php if($this->session->product_for_student == 1){ echo 'checked'; } ?> /> <label for="for_student">Student members</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="amount">Price (<?php echo $currency_symbol; ?>)</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $this->session->product_price; ?>" placeholder="E.g. 25750.50" required />
                                        <small class="text-muted">*** Enter amount <b>without</b> comma ***</small>
                                    </div>
                                </div>
                            </div>

                            <?php
                              if($product_type == 'Subscription')
                              {
                                $this->load->view('inc/subscription_product_view');
                              }
                              else
                              {
                                $this->load->view('inc/non_subscription_product_view');
                              }
                            ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="status">Product status</label>
                                    </div>
                                    <div class="col-md-9">
                                      <select name="status" id="" class="form-control">
                                        <option value="">-- Select an option --</option>
                                        <option value="Available" <?php if($this->session->product_status == 'Available'){ echo 'selected'; } ?>>Available</option>
                                        <option value="NOT Available" <?php if($this->session->product_status == 'NOT Available'){ echo 'selected'; } ?>>NOT Available</option>
                                      </select>
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