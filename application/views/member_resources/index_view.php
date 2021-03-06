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
              <li class="breadcrumb-item active" aria-current="page">Member resources</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              Resourse list
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
                                  <th>Item</th>
                                  <th>Type</th>
                                </tr>
                                </thead>';
                              $i = $start;
                              foreach ($resources as $resource) {
                                  if($resource->type == 'Downloadable')
                                  {
                                    $item_type = '<span class="badge badge-pill badge-info">Downloadable</span>';
                                  }
                                  else
                                  {
                                    $item_type = '<span class="badge badge-pill badge-light">Non-downloadable</span>';
                                  }
                                  echo '<tr>
                                      <td><b>'.$i.'</b></td>
                                      <td><a href="'.base_url().'member_resources/item/'.$resource->id.'" class="table-link">'.$resource->name.'</a></td>
                                      <td>'.$item_type.'</td>
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
                            <div class="col-6"><div class="page-description"><?php echo $start.' to '.$end.' of '.$total; ?> Items</div></div>
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
          <div class="related-action">
            <div class="action-title">Related Actions</div>
            <div class="action-body">
                <a href="<?php echo base_url().'member_resources/create/'; ?>" class="btn btn-sm btn-primary">Create new resource</a>
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