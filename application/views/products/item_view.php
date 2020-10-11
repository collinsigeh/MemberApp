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
              <li class="breadcrumb-item active" aria-current="page"><?php echo $product->name; ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <?php echo form_open(base_url().'products/update/'); ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Product details
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
                                <input type="hidden" name="product_type" value="<?php echo $product->type; ?>" required />
                                <input type="text" class="form-control" name="v_product_type" value="<?php echo $product->type; ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">Product name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $product->name; ?>" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="amount">Price (<?php echo $currency_symbol; ?>)</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $product->amount; ?>" placeholder="E.g. 25750.50" required />
                            </div>
                        </div>
                    </div>

                    <?php
                      if($product->type == 'Subscription')
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
                                <option value="Available" <?php if($product->status == 'Available'){ echo 'selected'; } ?>>Available</option>
                                <option value="NOT Available" <?php if($product->status == 'NOT Available'){ echo 'selected'; } ?>>NOT Available</option>
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