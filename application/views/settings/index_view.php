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
              <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          
          <div class="related-action">
            <div class="action-title">Related Actions</div>
            <div class="action-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="action-item">
                    <a href="<?php echo base_url().'settings/application'; ?>" class="btn btn-sm btn-outline-secondary">Application settings</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="action-item">
                    <a href="<?php echo base_url().'settings/automated_emails'; ?>" class="btn btn-sm btn-outline-secondary">Automated email messages</a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="action-item">
                    <a href="<?php echo base_url().'settings/payment_processors'; ?>" class="btn btn-sm btn-outline-secondary">Payment processors</a>
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