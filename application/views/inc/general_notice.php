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

    foreach($subscriptions as $subscription)
    {
      $no_expired_subscriptions = 0;
      if($now >= $subscription->subscription_end)
      {
        $no_expired_subscriptions++;
      }
      if($no_expired_subscriptions == 1)
      {
        ?>
        <div class="alert alert-info">
          <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> You have an expired subscription.          
        </div>
        <?php
      }
      elseif($no_expired_subscriptions > 1)
      {
        ?>
        <div class="alert alert-info">
          <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> You have expired subscriptions.          
        </div>
        <?php
      }
    }

    if(count($unpaid_orders) > 0)
    {
      ?>
      <div class="alert alert-info">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> You have unpaid invoice. <a href="#">Check order history</a>.         
      </div>
      <?php
    }
  ?>
</div>