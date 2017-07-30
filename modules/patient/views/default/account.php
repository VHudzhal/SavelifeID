<?php
 /**
  * @var $model \app\modules\patient\models\Patient
  * @var $this \yii\web\View
  */
  \app\assets\AjaxFormAsset::register($this);
  $this->title = 'Account Information';

?>
<div class="panel-body">
    <?php
      $form = \app\components\ActiveForm::begin([
        'id' => 'subscriber-home-account-personal-information-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'fieldConfig' => [
          'template' => "\n<div class='form-group'>{label}:{input}{error}</div>",
          'labelOptions' => ['class' => 'control-label'],
        ],
      ]);
    ?>

    <h3>Personal information</h3>
    <?php if (\Yii::$app->session->hasFlash('success')) {
      echo \yii\bootstrap\Alert::widget([
        'options' => [
          'class' => 'alert-success',
        ],
        'body' => \Yii::$app->session->getFlash('success'),
      ]);
    } ?>
    <div class="row">
      <div class="col-sm-8">
        <div class="row">
          <?= $form->field($model, 'first_name', ['options' => ['class' => 'form-group col-md-5']])->textInput(); ?>
          <?= $form->field($model, 'middle_initial', ['options' => ['class' => 'form-group col-md-2']])->textInput() ?>
          <?= $form->field($model, 'last_name', ['options' => ['class' => 'col-md-5']])->textInput() ?>
        </div>

        <div class="row">
          <?= $form->field($model, 'address_1', ['options' => ['class' => 'form-group col-md-6']])->textInput() ?>
          <?= $form->field($model, 'address_2', ['options' => ['class' => 'form-group col-md-6']])->textInput() ?>
        </div>

        <div class="row">
          <?= $form->field($model, 'city', ['options' => ['class' => 'form-group col-md-5']])->textInput() ?>
          <?= $form->field($model, 'state', ['options' => ['class' => 'form-group col-md-3']])->textInput() ?>
          <?= $form->field($model, 'zip', ['options' => ['class' => 'form-group col-md-4']])->textInput() ?>
        </div>
        <div class="row">
          <div class="form-group col-sm-12">
            <div class="form-group">
              <?= $form->field($model, 'display_address', [
                'template' => '{input}{label}&nbsp;{label}'
              ])->checkbox(['label' => null], false) ?>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-sm-4">
        <!-- User picture -->

        <?php /* if ($model->picture){  */?>
            <div class="patient-photo">
              <?= $form->field($model, 'picture', ['template' => '{input}'])->hiddenInput() ?>
              <img src="<?= $model->getPhoto() ?>" class="img-rounded" style="width:100%">
              <span class="btn btn-default btn-sm pull-right fileinput-button" style="margin-top:10px;">
               <span>Change profile picture</span>
                  <?= \dosamigos\fileupload\FileUpload::widget([
                    'useDefaultButton' => false,
                    'name' => 'profile-image',
                    'value' => 'Change profile picture',
                    'url' => ['/subscriber-home/upload-profile'], // your url, this is just for demo purposes,
                    'options' => ['accept' => 'image/*'],
                    'clientOptions' => [
                      'maxFileSize' => 2000000
                    ],
                    // Also, you can specify jQuery-File-Upload events
                    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
                    'clientEvents' => [
                      'fileuploadstart' => 'function(e, data) {
                         $(".patient-photo img").data("src", $(".patient-photo img").attr("src")).attr("src", "/img/preloader.gif");
                       }',
                      'fileuploaddone' => 'function(e, data) {
                         if (data.result.error){
                           eModal.alert("<div class=\"alert alert-danger\">"+data.result.error+"</div>", "Upload error");
                           $(".patient-photo img").attr("src", $(".patient-photo img").data("src"));
                         } else { 
                           $(".patient-photo img").attr("src", data.result.url);
                           $("#patient-picture").val(data.result.filename);
                         }
                       }',
                      'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                      }',
                    ],
                  ]); ?>
               </span>
            </div>
            <br>
        <?php /* } */ ?>
        <?php /*= $form->field($model, 'email', ['options' => [
      'class' => 'form-group col-md-7 padding-right-0'],
      'template' => "<div class='form-group'>{label}:<div class=\"input-group\">
          {input}<div class=\"input-group-btn\">
            <button type=\"button\" tabindex=\"999\" class=\"btn btn-primary\">Change e-mail</button></div></div>{error}</div>"
    ])->textInput(['disabled' => 'disabled', 'aria-required' => "true"]) ?>

      <!-- User picture -->
      <?php if ($model->picture){ ?>
        <div class="content" style="width:100%;position:relative;">
          <img src="<?= $model->getPhoto() ?>" class="img-rounded" style="width:100%">
          <!--<button class="btn btn-default btn-sm" style="position:absolute;right:10px;top:10px">Change profile picture</button>-->
        </div>
        <br>
      <?php } */ ?>

      </div>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <div class="row">
          <?= $form->field($model, 'cell_phone', ['options' => ['class' => 'form-group col-md-5']])->textInput() ?>

          <?= $form->field($model, 'email', [
            'options' => ['class' => 'form-group col-md-7'],
            'template' => "<div class='form-group'>{label}:{input}{error}</div>"
          ])->textInput(['disabled' => 'disabled', 'aria-required' => "true"]) ?>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <div class="form-group">
            <label class="control-label">&nbsp;</label>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-success right">Save information</button>
          </div>
        </div>

      </div>
    </div>


    <?php \app\components\ActiveForm::end() ?>
  </div>
