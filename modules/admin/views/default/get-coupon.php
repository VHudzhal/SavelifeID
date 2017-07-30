<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 20.06.17
 * Time: 16:16
 *
 * @var $coupon Stripe\Coupon
 */
?>
<?php if ($coupon){ ?>
<p>Coupon:</p>
<div class="input-group">
  <input id="coupon-id" type="text" class="form-control" value="<?= $coupon->id ?>">
  <span class="input-group-btn">
    <button class="btn btn-success js-copy" data-clipboard-target="#coupon-id" type="button">Copy</button>
  </span>
</div>
<?php } else { ?>
    <div class="alert alert-danger"><?= \yii\helpers\Html::errorSummary(Yii::$app->stripe) ?></div>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function(){
    var clipboard = new Clipboard('.js-copy');
  });
</script>
