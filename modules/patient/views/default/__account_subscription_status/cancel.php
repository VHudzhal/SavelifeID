<?php /** @var $this \yii\web\View */ ?>

<div class="panel-body">
  <h3>Subscription status
    <span class="label label-danger" style="margin-left:10px">Inactive</span></h3>
  <div class="alert alert-danger">
    Overdue payment failed.  Please <a href="#" class="alert-link" data-toggle="modal" data-target="#reactivateModal">fix the problem</a> to reactivate service.
  </div>

  <div>
    <p>Your account is <b>inactive</b>. This means a scan of your card or bracelet will <b>not</b> display your profile. Please click the button above to Reactivate your account.</p>
    <button type="button" class="btn btn-success right" data-toggle="modal" data-target="#reactivateModal">Reactivate Account</button>
  </div>
</div>

<?= $this->render('_modal/__reactivate') ?>

<?php if (Yii::$app->request->get('mode', 'false') == 'popup'){
  $this->registerJs("
$('#reactivateModal').modal('show');
");
} ?>
