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
              <li class="breadcrumb-item active" aria-current="page">Payments</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              List of payments
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
                                  <th>Amount</th>
                                  <th>Ref</th>
                                  <th>Date</th>
                                  <th>Status</th>
                                </tr>
                                </thead>';
                              $i = $start;
                              foreach ($payments as $payment) {
                                  if($payment->status == 'Confirmed')
                                  {
                                    $status = '<span class="badge badge-pill badge-success">Confirmed</span>';
                                  }
                                  elseif($payment->status == 'Confirmed')
                                  {
                                    $status = '<span class="badge badge-pill badge-warning">Unconfirmed</span>';
                                  }
                                  else
                                  {
                                    $status = '<span class="badge badge-pill badge-danger">Invalid</span>';
                                  }
                                  echo '<tr>
                                      <td><b>'.$i.'</b></td>
                                      <td><b>'.$payment->currency_symbol.' '.$payment->amount.'</b></td>
                                      <td>'.$payment->ref.'</td>
                                      <td><small>'.date('d-M-Y', $payment->created_at).'</small></td>
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