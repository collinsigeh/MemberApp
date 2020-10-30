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

          <div class="userguide">
            <div class="section-links">
                <ul>
                    <li><a href="#">How to verify / confirm new member account</a></li>
                    <li><a href="#">How to grant subscription to a member</a></li>
                </ul>
            </div>

            <div class="section-item">
                <h4 class="sub-heading">How to verify / confirm new member account</h4>
                <div class="answer">
                    <p>Ensure you are logged in (<i>of cause you have to be an admin</i>).</p>
                    <p>Click on the <b>User Accounts</b> link.</p>
                    <img src="<?php echo base_url().'assets/img/user_guide/image_1.png'; ?>" alt="photo_ref">
                    <p>Look for and click on the user to verify/confirm.</p>
                    <img src="<?php echo base_url().'assets/img/user_guide/image_2.png'; ?>" alt="photo_ref">
                    <p>Scroll to the <b>Account setting</b> section, select the <b>Account status</b> of choice.</p>
                    <img src="<?php echo base_url().'assets/img/user_guide/image_3.png'; ?>" alt="photo_ref">
                    <p>Scroll down and click on the <b>Save</b> button.</p>
                </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>