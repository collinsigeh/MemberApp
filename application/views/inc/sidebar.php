<a href="#">My Profile</a>
<hr>
<a href="#">My Subscription <?php if($no_unpaid_orders > 0){ echo '<span class="badge badge-pill badge-danger">'.$no_unpaid_orders.'</span>'; }; ?> </a>
<hr>
<a href="#">Resource Centre</a>
<hr>
<a href="#">Order History</a>
<hr>
<a href="<?php echo base_url().'dashboard/logout/'; ?>">Logout</a>