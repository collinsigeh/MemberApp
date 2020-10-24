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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard/subscriptions/'; ?>">My subscriptions</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php if(strlen($subscription->product_name) > 18){ echo substr($subscription->product_name, 0, 18).'...'; }else{ echo $subscription->product_name; } ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Subscription details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                    <div class="col-12">

                    <div class="form3">
                        <div class="shop-item-name">
                            <?php echo $subscription->product_name; ?>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Subscription status:
                                </div>
                                <div class="col-md-9">
                                    <?php
                                        if($now < $subscription->subscription_end && $now > $subscription->subscription_start)
                                        {
                                            $status = '<span class="badge badge-pill badge-success">Active</span>';
                                        }
                                        elseif($now >= $subscription->subscription_end)
                                        {
                                            $status = '<span class="badge badge-pill badge-danger">Expired</span>';
                                        }
                                        else
                                        {
                                            $status = '<span class="badge badge-pill badge-info">Invalid</span>';
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-3">
                                            <?php echo $status; ?>
                                        </div>
                                        <div class="col-9">
                                            <?php
                                                if($now >= $subscription->subscription_end && $subscription->manager_email == $this->session->email)
                                                {
                                                    $this->load->view('inc/payment_buttons/paystack');
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Subscription code:
                                </div>
                                <div class="col-md-9">
                                    <?php echo $subscription->subscription_code; ?>
                                </div>
                            </div>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    User limit:
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo $subscription->user_limit; ?></b>
                                </div>
                            </div>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Subscription users
                                </div>
                                <div class="col-md-9">
                                    <small>
                                        <table class="table table-bordered table-small">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sn = 1;
                                                    foreach ($subscription_users as $user) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $sn; ?></td>
                                                            <td><?php echo $user->firstname.' '.$user->lastname; ?></td>
                                                            <td><?php echo $user->email; ?></td>
                                                            <td><?php echo $user->phone; ?></td>
                                                        </tr>
                                                        <?php
                                                        $sn++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </small>
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