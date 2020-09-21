<div class="message">
    <?php
      if(strlen($this->session->action_error_message) > 0)
      {
        ?>
        <div class="alert alert-danger">
          <img src="<?php echo base_url(); ?>assets/img/icon_images/error_info.png" class="info-icon" > <b>Error:</b> Invalid password.
        </div>
        <?php
        $this->session->action_error_message = '';
      }
      if(strlen($this->session->action_success_message) > 0)
      {
        ?>
        <div class="alert alert-success">
          <img src="<?php echo base_url(); ?>assets/img/icon_images/success_info.png" class="info-icon" > <b>Success:</b> Password changed.
        </div>
        <?php
        $this->session->action_success_message = '';
      }
    ?>
</div>