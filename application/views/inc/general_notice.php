<div class="notice">
  <?php
    if($this->session->user_type == 'Admin')
    {
      if($no_pending_accounts == 1)
      {
        ?>
        <div class="alert alert-info">
          <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> <?php echo $no_pending_accounts; ?> user account is <b>pending approval</b>.  <a href="<?php echo base_url().'users/pending_accounts/'; ?>">View details</a>!      
        </div>
        <?php
      }
      elseif($no_pending_accounts > 1)
      {
        ?>
        <div class="alert alert-info">
          <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> <?php echo $no_pending_accounts; ?> user accounts are <b>pending approval</b>.  <a href="<?php echo base_url().'users/pending_accounts/'; ?>">View details</a>!      
        </div>
        <?php
      }
    }

    if($this->session->status == 'Pending Approval')
    {
      ?>
      <div class="alert alert-info">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> Your account is <b>pending approval</b>.  Contact NUSA secretary!      
      </div>
      <?php
    }
    if($this->session->status == 'Suspended')
    {
      ?>
      <div class="alert alert-danger">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> Your account is <b>inactive</b>. Contact NUSA secretary!   
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

    if($no_unpaid_orders == 1)
    {
      ?>
      <div class="alert alert-info">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> You have unpaid invoice. <a href="<?php echo base_url().'dashboard/orders/'; ?>">Check order history</a>.         
      </div>
      <?php
    }
    elseif($no_unpaid_orders > 1)
    {
      ?>
      <div class="alert alert-info">
        <img src="<?php echo base_url(); ?>assets/img/icon_images/notice.png" class="notice-icon" ><b>Notice:</b> You have unpaid invoices. <a href="<?php echo base_url().'dashboard/orders/'; ?>">Check order history</a>.         
      </div>
      <?php
    }
  ?>
</div>