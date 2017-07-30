<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.06.17
 * Time: 12:15
 */
?>



<p>Unfortunately your most recent invoice payment for <?= $total/100 ?> have failed.</p>
<p>This could be due to a change in your card number or your card expiring, cancellation of your credit card, or the bank not recognizing the payment and taking action to prevent it.</p>
<p>Your service is no longer active. This means that scanning your SaveLifeID card or bracelet will not display your medical profile in an emergency.</p>
<p>You can still log in to your account, though, and all your information remains there ready for use once you login and fix the payment problem.</p>

<p>Please update your payment information as soon as possible by logging in here:
<?php
  $href = \yii\helpers\Url::to('/subscriber-home/account-status?mode=popup', true);
  echo \yii\helpers\Html::a($href, $href);
?>
</p>
