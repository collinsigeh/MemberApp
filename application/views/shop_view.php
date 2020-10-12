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
              <li class="breadcrumb-item active" aria-current="page">My subscriptions</li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>
          <div class="dashboard-section">
            <div class="section-heading">
              My subscriptions
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                  <div class="col-12">

                  <div class="form3">
                    <?php
                        if($total < 1)
                        {
                            echo '<div class="alert alert-info">None available.</div>';
                        }
                        else
                        {
                            ?>
                            <div class="row">
                                <?php
                                    foreach ($products as $product) {
                                        ?>
                                        <div class="col-md-6">
                                            <div class="shop-item">
                                                <div class="product">
                                                    <div class="item-name">
                                                        <?php echo $product->name; ?>
                                                    </div>
                                                    <div class="item-price">
                                                        <?php echo $product->currency_symbol.' '.$product->amount; ?>
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="#">View</a>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <a href="#">Buy now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                            if($total > 0)
                            {
                                ?>
                                <small>
                                <div class="row pagination">
                                    <div class="col-6"><div class="page-links"><?php echo $this->pagination->create_links(); ?></div></div>
                                    <div class="col-6"><div class="page-description">Items <?php echo $start.' to '.$end.' of '.$total; ?></div></div>
                                </div>
                                </small>
                                <?php
                            }
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