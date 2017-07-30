<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 12:15
 */
?>
<p>Unfortunately your most recent invoice payment for <?= $total/100 ?> was declined.</p>
<p>This could be due to a change in your card number or your card expiring, cancellation of your credit card, or the bank not recognizing the payment and taking action to prevent it.</p>
<p>Your service is still active for now so you can fix the problem without any interruption in your SaveLifeID coverage.</p>
<p>But service will be deactivated in <?= $weeks ?> weeks.</p>
<p>Please update your payment information as soon as possible by logging in here:
<?php
  $href = \yii\helpers\Url::to('/subscriber-home/account-status?mode=popup', true);
  echo \yii\helpers\Html::a($href, $href);
?>
</p>
