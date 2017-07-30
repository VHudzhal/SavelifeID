<h1 class="left" style="margin-top:15px">New registration: Billing</h1>

<ul class="pagination right">
	<?= $this->params['submenu'] ?>
</ul>

<div class="error"></div>

<div class="alert alert-success" style="clear:both">
  <strong>STEP 2:</strong> Manage your billing and credit card information.
</div>
<div class="alert alert-info">
  Please enter the requested billing information below. <strong>All fields are required.</strong>
</div>

<form action="/register/profile/" class="enrollment" id="enrollment_form" name="account_updates" method="post">

  <input type="hidden" name="RET" value="/register/subscribe">
  <input type="hidden" name="form_type" value="modify_status">
  <input type="hidden" name="username" id="username" value="">

  <div class="col-sm-4">
    You are currently subscribed to SaveLifeID:

    <div class="radio">
      <label><input type="radio" name="optradio" value="active" name="membership_status" checked=""> Active - Your Yearly Membership Expires on 2017-12-06</label>
    </div>
    <div class="radio">
      <label><input type="radio"  value="cancel" name="membership_status"> Cancel My Subscription</label>
    </div>

    <button type="submit" class="btn btn-success right">Submit</button>

</form>