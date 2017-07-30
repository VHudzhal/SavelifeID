<?php
  /**
   * @var $model \app\models\LoginForm
   * @var $this \yii\web\View
   */
?>
<h3>Hi <?= $model->forgotModel->getFullName() ?>,</h3>

<p>You're receiving this email because you requested a password reset for your Account.
If you did not request this change, you can safely ignore this email.</p>

<p>To choose a new password and complete your request, please follow the link below:</p>

<?= \yii\helpers\Url::to('/forgot?slid='.md5($model->forgotModel->internal_id).'&key='.md5($model->forgotModel->salt), true) ?>

<p>If it is not clickable, please copy and paste the URL into your browser's address bar.</p>

<p>You can change your password again at any time from within your Account at <?= \yii\helpers\Url::to('/', true) ?>.</p>
