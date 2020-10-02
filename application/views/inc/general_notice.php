<div class="notice">
  <?php
    if($this->session->status == 'Pending Approval')
    {
      ?>
      <div class="alert alert-info">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> Your account is pending approval.          
      </div>
      <?php
    }
    if($this->session->status == 'Suspended')
    {
      ?>
      <div class="alert alert-danger">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> Your account is suspended.          
      </div>
      <?php
    }
  ?>
    <div class="alert alert-info">
      <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> Your subscription has expired.          
    </div>
    <div class="alert alert-info">
      <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> You have unpaid invoice. <a href="#">Check order history</a>.         
    </div>
</div>