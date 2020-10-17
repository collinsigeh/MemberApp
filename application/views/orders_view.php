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
              <li class="breadcrumb-item active" aria-current="page">Order history</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              My orders
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
                                echo '<tr><td>None found</td><td class="text-right"><a href="'.base_url().'dashboard/shop/" class="btn btn-sm btn-primary">Start shopping</a></td></tr>';
                            }
                            else
                            {
                              echo '<thead>
                                  <tr>
                                  <th>#</th>
                                  <th>Item</th>
                                  <th>Date</th>
                                  <th></th>
                                </tr>
                                </thead>';
                              $i = $start;
                              foreach ($orders as $order) {
                                if($order->status == 'Paid')
                                {
                                  $status = '<span class="badge badge-pill badge-success">Paid</span>';
                                }
                                elseif($order->status == 'Unpaid')
                                {
                                    $status = '<span class="badge badge-pill badge-danger">Unpaid</span>';
                                }
                                elseif($order->status == 'Delivered')
                                {
                                    $status = '<span class="badge badge-pill badge-light">Completed</span>';
                                }
                                elseif($order->status == 'Cancelled')
                                {
                                    $status = '<span class="badge badge-pill badge-warning">Cancelled</span>';
                                }
                                else
                                {
                                    $status = '<span class="badge badge-pill badge-info">Invalid</span>';
                                }
                                echo '<tr>
                                      <td><b>'.$i.'</b></td>
                                      <td><a href="'.base_url().'dashboard/order_item/'.$order->id.'" class="table-link">'.$order->description.'</a></td>
                                      <td><small>'.date('d-M-Y', $order->created_at).'</small></td>
                                      <td>'.$status.'</td>
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
          
        </div>
      </div>

      <div class="col-md-4">
        <div class="sidebar">
          <!-- Sidebar -->
          <?php
            $this->load->view('inc/sidebar'); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>