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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard/resources/'; ?>">Resource center</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php if(strlen($resource->name) > 18){ echo substr($resource->name, 0, 18).'...'; }else{ echo $resource->name; } ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Resource details
            </div>
            <div class="section-body">
              <div class="section-item">
                <div class="row">
                    <div class="col-12">

                    <div class="form3">
                        <div class="shop-item-name">
                            <?php echo $resource->name; ?>
                        </div>

                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Item description:
                                </div>
                                <div class="col-md-9">
                                    <b><?php echo $resource->description; ?></b>
                                </div>
                            </div>
                        </div>
                        
                        <div class="shop-item-details">
                            <div class="row">
                                <div class="col-md-3">
                                    Other details:
                                </div>
                                <div class="col-md-9">
                                    <small>
                                        <table class="table table-bordered table-small">
                                            <tr>
                                                <th>Item type</th>
                                                <td>
                                                    <?php echo $resource->type; ?>
                                                </td>
                                            </tr>
                                            <?php
                                                if($resource->type == 'Downloadable')
                                                {
                                                    ?>
                                                    <tr>
                                                        <th>Download link</th>
                                                        <td>
                                                            <?php echo $resource->download_link; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
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