<!-- userSubscriptionModal -->
<div class="modal fade" id="userSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="userSubscriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userSubscriptionModalLabel">Subscription details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <small>
        <div class="alert alert-info">
            Here are subscriptions for <?php echo $user->firstname.' '.$user->lastname; ?>
        </div>
        <table class="table table-small">
        <?php
        $sub_no = 1;
        foreach ($subscriptions as $subscription) {
            if($subscription->cancel == 1)
            {
                $subscription_status = '<span class="badge badge-pill badge-danger">Cancelled</span>';
            }
            else
            {
                if($now < $subscription->subscription_end && $now > $subscription->subscription_start)
                {
                $subscription_status = '<span class="badge badge-pill badge-success">Active</span>';
                }
                elseif($now >= $subscription->subscription_end)
                {
                    $subscription_status = '<span class="badge badge-pill badge-danger">Expired</span>';
                }
                else
                {
                    $subscription_status = '<span class="badge badge-pill badge-info">Inactive</span>';
                }
            }
            ?>
            <tr>
                <td style="vertical-align: top;"><?php echo $sub_no; ?></td>
                <td>
                    <div class="alert alert-secondary">
                        <p><?php echo '<b>'.$subscription->product_name.'</b> '.$subscription_status; ?></p>
                        <b>Valid from: </b> <?php echo date('D d M, Y', $subscription->subscription_start).' <b>- to -</b> '.date('D d M, Y', $subscription->subscription_end); ?>
                    </div>
                </td>
            </tr>
            <?php
            $sub_no++;
        }
        ?>
        </table>
        </small>
      </div>
    </div>
  </div>
</div>
<!-- End userSubscriptionModal -->