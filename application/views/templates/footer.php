

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
	
    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");
        
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
          } else {
            mybutton.style.display = "none";
          }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
    </script>

</body>

</html>