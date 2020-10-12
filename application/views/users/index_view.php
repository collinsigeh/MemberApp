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
              <li class="breadcrumb-item active" aria-current="page">User accounts</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              User list
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-small">
                        <?php
                            if($total < 1)
                            {
                                echo '<tr><td>None found</td></tr>';
                            }
                            else
                            {
                              echo '<thead>
                                  <tr>
                                  <th>#</th>
                                  <th>User detail</th>
                                  <th>Account</th>
                                </tr>
                                </thead>';
                              $i = $start;
                              foreach ($users as $user) {
                                  if($user->user_type == 'Admin')
                                  {
                                    $user_type = '<span class="badge badge-pill badge-info">Admin</span>';
                                  }
                                  else
                                  {
                                    $user_type = '<span class="badge badge-pill badge-light">Member</span>';
                                  }
                                  echo '<tr>
                                      <td><b>'.$i.'</b></td>
                                      <td><a href="'.base_url().'users/account/'.$user->id.'" class="table-link"><img src="'.base_url().'assets/img/profile_images/profile_default.png" class="table-profile-icon" >'.$user->firstname.' '.$user->lastname.' ('.$user->email.')</a></td>
                                      <td>'.$user_type.'</td>
                                      </tr>';
                                  $i++;
                              }
                            }
                        ?>
                        </table>
                    </div>
                    <small>
                    <div class="row pagination">
                        <div class="col-6"><div class="page-links"><?php echo $this->pagination->create_links(); ?></div></div>
                        <div class="col-6"><div class="page-description">Users <?php echo $start.' to '.$end.' of '.$total; ?></div></div>
                    </div>
                    </small>
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