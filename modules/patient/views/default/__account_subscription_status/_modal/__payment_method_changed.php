<?php /** @var $this \yii\web\View */ ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('.cc_last4').html('<?= $card->last4 ?>');
    $('.cc_brand').html('<?= $card->brand ?>');
    $('.cc_exp').html('<?= $card->exp_month.'/'.$card->exp_year ?>');
    $('#ChangePaymentMethodModal').modal('toggle');
    $('#ReviewPaymentMethodModal').modal('toggle');
  });
</script>
<?= $this->render('__change_payment_method', ['partial' => true]) ?>