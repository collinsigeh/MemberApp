<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="main-content">
          <!-- Main content -->
          <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php if($this->session->userlogged_in == '#loggedin@Yes'){ echo base_url().'dashboard'; }else{ echo 'https://nusa.ng/'; } ?>"><img src="<?php echo base_url().'assets/img/icon_images/homepage_icon.png'; ?>" alt="Dashboard" class="homepage-icon" ></a></li>
              <li class="breadcrumb-item active" aria-current="page">Members directory</li>
            </ol>
          </nav>
          </div>
          
          <div class="dashboard-section">
            <div class="section-heading">
              List of members
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
                                  <th>Name</th>
                                  <th>Membership</th>
                                  <th>Member Status</th>
                                </tr>
                                </thead>';
                              $i = $start;
                              foreach ($members as $member) {
                                echo '<tr>
                                      <td><b>'.$i.'</b></td>
                                      <td>'.$member->firstname.' '.$member->lastname.'</td>
                                      <td>'.$member->membership.'</td>
                                      <td>'.$member->use_status.'</td>
                                      </tr>';
                                $i++;
                              }
                            }
                        ?>
                        </table>
                    </div>
                    <?php
                    if($total > 0)
                    {
                        ?>
                        <small>
                        <div class="row pagination">
                            <div class="col-6"><div class="page-links"><?php echo $this->pagination->create_links(); ?></div></div>
                            <div class="col-6"><div class="page-description"><?php echo $start.' to '.$end.' of '.$total; ?> Members</div></div>
                        </div>
                        </small>
                        <?php
                    }
                    ?>
                  </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>