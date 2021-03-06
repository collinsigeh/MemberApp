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
              <li class="breadcrumb-item active" aria-current="page">Payment processors</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              Payment processors
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-small">
                        <?php
                            $item_count = 0;
                            foreach ($payment_processors as $payment_processor) {
                                echo '<tr><td><a href="'.base_url().'settings/payment_processor/'.$payment_processor->id.'" class="table-link"><img src="'.base_url().'assets/img/icon_images/payment_processor.png" class="table-item-icon" >'.$payment_processor->name.'</a></td></tr>';
                                $item_count++;
                            }
                            if($item_count == 0)
                            {
                                echo '<tr><td>None found</td><tr>';
                            }
                        ?>
                        </table>
                    </div>
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