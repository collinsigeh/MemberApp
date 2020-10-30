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
              <li class="breadcrumb-item active" aria-current="page">User guide</li>
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
                tips here
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>