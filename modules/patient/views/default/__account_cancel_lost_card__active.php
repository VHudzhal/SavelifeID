<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 29.03.17
 * Time: 17:03
 *
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\TokenAssociations
 */

$tokenType = $model->type?ucfirst($model->type->text):'<span class="red">Unknown token type</span>';
?>

<?php if ($model->active == 1 ){ ?>
  <div class="well">
    <h5><?= $tokenType ?> SLID#: <?= $model->token_slid ?></h5>
    <p>If your <?= $tokenType ?> is lost or stolen, you should deactivate it to protect your medical information from being accessed by anyone who might find it and scan it.</p>
    <form class="kvk-ajax-form simple-ajax-form" data-target="#token-wrapper-<?= $model->association_id ?>" action="/subscriber-home/deactivate-token" method="post">
      <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
      <input type="hidden" name="token" value="<?= $model->association_id ?>">
      <button class="btn btn-danger">Deactivate</button>
    </form>
  </div>
<?php } else { ?>
  <div class="well">
    <h5><?= $tokenType ?> SLID#: <?= $model->token_slid ?></h5>
    <p>Your card is  presently inactive, and will not display your emergency medical profile if scanned.  You can activate it now if you like.</p>
    <form class="kvk-ajax-form simple-ajax-form" data-target="#token-wrapper-<?= $model->association_id ?>" action="/subscriber-home/activate-token" method="post">
      <input type="hidden" name="token" value="<?= $model->association_id ?>">
      <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
      <button class="btn btn-success">Activate</button>
    </form>
  </div>
<?php } ?>

