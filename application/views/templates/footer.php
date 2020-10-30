

  <div class="text-center developer-badge">
    <?php 
      if($this->session->userlogged_in == '*#loggedin@Yes' && $this->session->user_type == 'Admin')
      {
        ?>
        <p><a href="<?php echo base_url().'user_guide'; ?>">User guide</a></p>
        <?php
      }
    ?>
    <small>Powered by <a href="https://verstaadtech.com" target="_blank">VerstaadTech</a></small>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url(); ?>assets/jquery/jquery.slim.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Payment scripts -->

</body>

</html>