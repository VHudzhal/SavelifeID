<?php
/**
 * @var $class string
 * @var $form \app\components\ActiveForm
 * @var $item string
 */
?>
<ul class="<?= $class ?>">
	<?php if ($item){ ?>
    <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
			<?php /** @var $item string */ ?>
		    <div>
			    <?= $item ?>
		    </div>
		</li>
	<?php } ?>
</ul>

