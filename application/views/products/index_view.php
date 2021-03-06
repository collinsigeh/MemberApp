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
              <li class="breadcrumb-item active" aria-current="page">Products & subscriptions</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              Product list
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
                                  <th style="font-size: 0.8em;">Type</th>
                                  <th style="font-size: 0.8em;">Status</th>
                                </tr>
                                </thead>';
                              $i = $start;
                              foreach ($products as $product) {
                                  if($product->type == 'Subscription')
                                  {
                                    $product_type = '<span class="badge badge-pill badge-info">Subscription</span>';
                                  }
                                  else
                                  {
                                    $product_type = '<span class="badge badge-pill badge-light">Non-subscription</span>';
                                  }

                                  if($product->status == 'Available')
                                  {
                                  $status = '<span class="badge badge-pill badge-success">Available</span>';
                                  }
                                  elseif($product->status == 'NOT Available')
                                  {
                                      $status = '<span class="badge badge-pill badge-danger">NOT Available</span>';
                                  }
                                  else
                                  {
                                      $status = '<span class="badge badge-pill badge-light">Undefined</span>';
                                  }
                                  echo '<tr>
                                      <td><small><b>'.$i.'</b></small></td>
                                      <td><a href="'.base_url().'products/item/'.$product->id.'" class="table-link">'.$product->name.'</a></td>
                                      <td><small>'.$product_type.'</small></td>
                                      <td><small>'.$status.'</small></td>
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
                <a href="#" data-toggle="modal" data-target="#newProductModal" class="btn btn-sm btn-primary">Create new product</a>
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

<?php
    $this->load->view('inc/modal/new_product');
?>