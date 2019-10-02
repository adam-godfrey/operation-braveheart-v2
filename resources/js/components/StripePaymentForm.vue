<template>
    <form accept-charset="UTF-8" action="/" class="require-validation"
          data-cc-on-file="false"
          data-stripe-publishable-key="test_public_key"
          id="payment-form" method="post">
        <div class="form-row">
            <div class="col form-group required">
                <label class="control-label">Name on Card</label>
                <input class="form-control" size="4" type="text">
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group required">
                <label class="control-label">Card Number</label>
                <input autocomplete="off" class="form-control card-number" size="20" type="text">
            </div>
        </div>
        <div class="form-row">
            <div class="col-xs-4 form-group cvc required">
                <label class="control-label">CVC</label>
                <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="text">
            </div>
            <div class="col-xs-4 form-group expiration required">
                <label class="control-label">Expiration</label>
                <input class="form-control card-expiry-month" placeholder="MM" size="2" type="text">
            </div>
            <div class="col-xs-4 form-group expiration required">
                <label class="control-label"> </label>
                <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="text">
            </div>
        </div>
        <div class="form-row">
            <div class="col form-group">
                <button class="form-control btn btn-primary submit-button" type="submit" style="margin-top: 10px;">Pay »</button>
            </div>
        </div>
        <div class="form-row">
            <div class="col error form-group hide">
                <div class="alert-danger alert">Please correct the errors and try again.</div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log("Component mounted.")
        }
    }
</script>
