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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard/orders/'; ?>">Order history</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php if(strlen($order->description) > 18){ echo substr($order->description, 0, 18).'...'; }else{ echo $order->description; } ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Order details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                    <div class="col-12">

                    <div class="form3">
                        <div class="shop-item-name">
                            <?php echo $order->description; ?>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Amount due:
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo $order->currency_symbol.' '.$order->amount; ?></b>
                                </div>
                            </div>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Order status:
                                </div>
                                <div class="col-md-9">
                                    <?php
                                        if($order->status == 'Paid')
                                        {
                                        $status = '<span class="badge badge-pill badge-success">Paid</span>';
                                        }
                                        elseif($order->status == 'Unpaid')
                                        {
                                            $status = '<span class="badge badge-pill badge-danger">Unpaid</span> ';
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
                                    ?>
                                    <div class="row">
                                        <div class="col-3">
                                            <?php echo $status; ?>
                                        </div>
                                        <div class="col-9">
                                            <?php
                                                if($order->status == 'Unpaid')
                                                {
                                                    $this->load->view('inc/payment_buttons/paystack');
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            if(!empty($item_detail))
                            {
                                ?>
                                <div class="shop-item-details">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Other details:
                                        </div>
                                        <div class="col-md-9">
                                            <?php
                                                if($product->type == 'Subscription')
                                                {
                                                    ?>
                                                    <small>
                                                        <table class="table table-bordered table-small">
                                                            <tr>
                                                                <th>User limit</th>
                                                                <td>
                                                                    <?php
                                                                        if($item_detail->user_limit == 1)
                                                                        {
                                                                            echo '1 member only'; 
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $item_detail->user_limit.' members only'; 
                                                                        }
                                                                        
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Validity</th>
                                                                <td>
                                                                    <?php
                                                                        if($item_detail->duration == 1)
                                                                        {
                                                                            echo '1 day'; 
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $item_detail->duration.' days'; 
                                                                        }
                                                                        
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Created at</th>
                                                                <td>
                                                                    <?php echo date('h:iA - D d M, Y', $order->created_at); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </small>
                                                    <?php
                                                }
                                                elseif($product->type == 'Non-subscription')
                                                {
                                                    ?>
                                                    <small>
                                                        <table class="table table-bordered table-small">
                                                            <tr>
                                                                <th>Nature of Item</th>
                                                                <td><?php echo $item_detail->nature; ?></td>
                                                            </tr>
                                                            <?php
                                                                if($item_detail->nature == 'Downloadable')
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <th>Download link</th>
                                                                        <td><?php echo $item_detail->download_link; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <tr>
                                                                <th>Created at</th>
                                                                <td>
                                                                    <?php echo date('h:iA - D d M, Y', $order->created_at); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </small>
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