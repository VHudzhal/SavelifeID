<div class="modal fade " id="cancelModal" role="dialog" style="display: none;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" id="subscription-cancel">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cancel Account</h4>
			</div>
			<div class="modal-body">
				<p>This will remove all your information, disable all of your cards and bracelets, and is not reversible without re-enrollment from scratch.  Are you sure?</p>
			</div>
			<div class="modal-footer">
        <form class="kvk-ajax-form simple-ajax-form" method="post" action="/subscriber-home/set-status" data-target="#subscription-cancel .modal-body">
          <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
          <input type="hidden" name="status" value="<?= \app\modules\patient\models\Patient::STATUS_CANCEL ?>">
          <button type="submit" class="btn btn-danger">Yes, Cancel</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </form>
			</div>
		</div>
	</div>
</div>