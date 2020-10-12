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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard/shop/'; ?>">Members' shop</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $product->name; ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <?php echo form_open(base_url().'dashboard/confirm_order/'.$product->id); ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Item details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                    <div class="col-12">

                    <div class="form3">
                        <div class="shop-item-name">
                            <?php echo $product->name; ?>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Price:
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo $product->currency_symbol.' '.$product->amount; ?></b>
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
          
          <div class="update-button">
            <input class="custom-outline-button" type="submit" name="submit" value="Submit order" />
          </div>

          <?php form_close(); ?>

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