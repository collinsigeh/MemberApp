<form id="paymentForm">

  <input type="hidden" id="email-address" value="<?php echo $this->session->email; ?>" required />

  <input type="hidden" id="amount" value="<?php echo $order->amount; ?>" required />
  
  <input type="hidden" id="first-name" value="<?php echo $this->session->firstname; ?>" />
  
  <input type="hidden" id="last-name" value="<?php echo $this->session->lastname; ?>" />
  
  <button type="submit" onclick="payWithPaystack()" class="btn btn-sm btn-outline-primary">Make payment</button>
  
</form>


<script>
    const paymentForm = document.getElementById('paymentForm');

    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e) {

    e.preventDefault();

    let handler = PaystackPop.setup({

        key: '<?php echo $payment_processor->public_key; ?>', // Replace with your public key

        email: document.getElementById("email-address").value,

        amount: document.getElementById("amount").value * 100,

        firstname: document.getElementById("first-name").value,

        lastname: document.getElementById("last-name").value,

        ref: '<?php echo $order->id ?>', // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you

        // label: "Optional string that replaces customer email"

        onClose: function(){

        alert('Window closed.');

        },

        callback: function(response){

            window.location = "<?php echo base_url().'verify_transaction.php?reference='; ?>" + response.reference;

        }

    });

    handler.openIframe();

    }
  </script>
  <script src="https://js.paystack.co/v1/inline.js"></script>