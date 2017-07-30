<?php
  use app\components\Helper;
  /** @var $model \app\modules\patient\models\RecordForm */
?>
<?php $chunks = Helper::array_divide($model->emergency_profile_items,3); ?>
<div>
  <?= $this->render('__record_emergency_block', ['items' => $chunks[0], 'class' => 'list-group col-sm-4 margin-bottom-0']) ?>
  <?= $this->render('__record_emergency_block', ['items' => $chunks[1], 'class' => 'list-group col-sm-4 margin-bottom-0']) ?>
  <?= $this->render('__record_emergency_block', ['items' => $chunks[2], 'class' => 'list-group col-sm-4 padding-right-0 margin-bottom-0']) ?>
</div>

<div class="right col-sm-6 padding-right-0 padding-left-0" style="margin-top:15px">
  <div class="input-group">
    <input class="form-control js-custom-title js-no-autosave" placeholder="Add New Item of Free Text" type="text">
    <div class="input-group-btn">
      <button type='button' class="btn btn-default js-add-custom">Add</button>
    </div>
  </div>
</div>

<div class="hidden record-form-templates">
  <div class="removed-profile-item">
    <span class="glyphicon glyphicon-trash trash-icon"></span><strike class="item-title"></strike>
    <span class="label label-danger">Deleted</span>
    <div class="right">
      <button type="button" class="btn btn-success btn-xs js-restore-custom" data-title="">Restore</button>
    </div>
  </div>

  <ul class="custom-emergency-profile">
    <li class="list-group-item">
      <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper">
  	      <?= \yii\bootstrap\Html::hiddenInput('RecordForm[emergency_profile_items_ids][]', 0)?>
        <a href="#" class="glyphicon glyphicon-remove chk-6 top0 js-remove-profile-item" data-id=""  data-toggle="tooltip" data-placement="left" title="Click here to remove this custom-defined text from your emergency profile and from this list"></a>
      </span>
      <label class="item-name"></label>
      <div class="clearfix"></div>
    </li>
  </ul>

</div>
