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
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
            $this->load->view('inc/general_notice');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              Account summary
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-md-4">Membership</div>
                  <div class="col-md-8"><span class="badge badge-pill badge-secondary"><?php echo $this->session->membership; ?></span></div>
                </div>
              </div>
              <?php
                $no_subscriptions = 0;
                foreach($subscriptions as $subscription)
                {
                  ?>
                  <div class="section-item">
                    <div class="row">
                      <div class="col-md-4"><?php echo $subscription->product_name; ?></div>
                      <div class="col-md-8">
                      <?php
                        if($now < $subscription->subscription_end && $now > $subscription->subscription_start)
                        {
                          echo '<span class="badge badge-pill badge-success">Active</span>';
                        }
                        elseif($now >= $subscription->subscription_end)
                        {
                          echo '<span class="badge badge-pill badge-danger">Expired</span>';
                        }
                        else
                        {
                          echo '<span class="badge badge-pill badge-info">Inactive</span>';
                        }
                      ?>
                      </div>
                    </div>
                  </div>
                  <?php
                  $no_subscriptions++;
                }
                if($no_subscriptions < 1 && $this->session->user_type == 'Member')
                {
                  ?>
                  <div class="section-item">
                    <div class="row">
                      <div class="col-md-4">Subscription</div>
                      <div class="col-md-8"><span class="badge badge-pill badge-danger">None</span> <small><a href="<?php echo base_url().'dashboard/shop/'; ?>">Subscribe now</a></small></div>
                    </div>
                  </div>
                  <?php
                }
              ?>
              <div class="section-item">
                <div class="row">
                  <div class="col-md-4">Account Status</div>
                  <div class="col-md-8">
                    <?php
                      if($this->session->status == 'Active')
                      {
                        echo '<span class="badge badge-pill badge-success">Active</span>';
                      }
                      elseif($this->session->status == 'Pending Approval')
                      {
                        echo '<span class="badge badge-pill badge-info">Pending Approval</span>';
                      }
                      elseif($this->session->status == 'Suspended')
                      {
                        echo '<span class="badge badge-pill badge-danger">Suspended</span>';
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <?php
          if($this->session->user_type == 'Member')
          {
            ?>
            <div class="related-action">
              <div class="action-title">Related Actions</div>
              <div class="action-body">
                <div class="row">
                  <?php
                  if($no_subscriptions > 0)
                  {
                    ?>
                    <div class="col-md-6">
                      <a href="#" class="btn btn-sm btn-outline-secondary">Manage Subcription</a>
                    </div>
                    <?php
                  }
                  else
                  {
                    ?>
                    <div class="col-md-6">
                      <a href="<?php echo base_url().'dashboard/shop/'; ?>" class="btn btn-sm btn-primary">New Subcription</a>
                    </div>
                    <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
      </div>

      <div class="col-md-4">
        <div class="sidebar">
          <!-- Sidebar -->
          <?php
            if($this->session->user_type == 'Admin')
            {
              $this->load->view('inc/admin_sidebar');
            }
            else
            {
              $this->load->view('inc/sidebar');
            } 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>