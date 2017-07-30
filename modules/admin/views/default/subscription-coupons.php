<?php
use \yii\helpers\BaseVarDumper;

/* @var $this yii\web\View */

\Eddmash\Clipboard\ClipboardAsset::register($this);

?>
<h2>Subscription Coupons</h2>

<p>
  <a href="/admin/get-coupon" data-target="#coupons" class="btn btn-primary js-ajaxify"><i class="glyphicon glyphicon-scissors"></i> Get Coupon</a>
</p>
<div id="coupons" class="col-sm-3 padding-left-0"></div>
