<!-- cancelOrderModal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="cancelOrderModalLabel">Cancel order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <small><div class="alert alert-info"><b>Note:</b> When you cancel an order, it is also deleted and cannot be restored.</div></small>
                <div class="form-group">
                    <label for="">Order item:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $order->description; ?></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Amount:</label>
                    <div class="alert alert-secondary">
                        <b><?php echo $order->currency_symbol.' '.$order->amount; ?></b>
                    </div>
                </div>
                <?php echo form_open(base_url().'dashboard/cancel_order/'.$order->id); ?>
                    <div class="form-group">
                        <label for="confirm">Confirm action:</label>
                        <input class="form-control" type="text" name="confirm" id="confirm" required />
                        <small class="text-muted">*** Type <b>DELETE</b> in the box above to confirm ***</small>
                    </div>
                    <div class="update-button">
                        <input type="submit" value="Submit" class="custom-outline-button">
                    </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
<!-- End cancelOrderModal -->