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
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
          </nav>
          </div>
          <?php 
            include('inc/action_message.php');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              Account Summary
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-md-4">Membership</div>
                  <div class="col-md-8"><span class="badge badge-pill badge-secondary">Individual</span></div>
                </div>
              </div>
              <div class="section-item">
                <div class="row">
                  <div class="col-md-4">Individual Subscription</div>
                  <div class="col-md-8"><span class="badge badge-pill badge-success">Active</span></div>
                </div>
              </div>
              <div class="section-item">
                <div class="row">
                  <div class="col-md-4">Account Status</div>
                  <div class="col-md-8"><span class="badge badge-pill badge-success">Active</span></div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="related-action">
            <div class="action-title">Related Actions</div>
            <div class="action-body">
              <div class="row">
                <div class="col-md-6">
                  <a href="#" class="btn btn-sm btn-primary">Manage Subcription</a>
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
            if($this->session->user_type == 'Admin')
            {
              include('inc/admin_sidebar.php');
            }
            else
            {
              include('inc/sidebar.php');
            } 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>