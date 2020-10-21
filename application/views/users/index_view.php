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
                                  <th>User</th>
                                  <th style="font-size: 0.8em;">Type</th>
                                  <th style="font-size: 0.8em;">Account status</th>
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

                                  if($user->status == 'Active')
                                  {
                                  $status = '<span class="badge badge-pill badge-success">Active</span>';
                                  }
                                  elseif($user->status == 'Suspended')
                                  {
                                      $status = '<span class="badge badge-pill badge-danger">Inactive</span>';
                                  }
                                  elseif($user->status == 'Pending Approval')
                                  {
                                      $status = '<span class="badge badge-pill badge-info">Pending Approval</span>';
                                  }
                                  else
                                  {
                                      $status = '<span class="badge badge-pill badge-light">Undefined</span>';
                                  }

                                  echo '<tr>
                                      <td><small><b>'.$i.'</b></small></td>
                                      <td><small><b><a href="'.base_url().'users/account/'.$user->id.'" class="table-link"><img src="'.base_url().'assets/img/profile_images/'.$user->photo.'" class="table-profile-icon" >'.$user->firstname.' '.$user->lastname.' ('.$user->email.')</a></b></small></td>
                                      <td><small>'.$user_type.'</small></td>
                                      <td><small>'.$status.'</small></td>
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
                        <div class="col-6"><div class="page-description"><?php echo $start.' to '.$end.' of '.$total; ?> Users</div></div>
                    </div>
                    </small>
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="related-action">
            <div class="action-title">Related Actions</div>
            <div class="action-body">
                <a href="<?php echo base_url().'users/create_admin/'; ?>" class="btn btn-sm btn-primary">Create new admin</a>
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