<?php

namespace app\modules\patient\controllers;

use app\modules\patient\models\TokenAssociations;
use app\modules\patient\models\Patient;
// add these in or remove them when we don't need them.
//use yii\base\Exception;
use yii\web\HttpException;
//use yii\web\NotFoundHttpException;

use yii\helpers\Url;

/**
 * Scan controller for the `patient` module
 *
 * Job is to receive the token id hash of a scan in the field (of card or bracelet),
 * lookup the hash in the token_associations table, and then route to the correct
 * action page based on the result.  Main case is profile scan where we translate
 * the hash into the enrollment slid and route to profile server with that id.
 */


class ScanController extends \app\components\Controller
{
	/**
	 * Routes the scan request to the correct destination based on token status in associations table
	 * @return string
	 */
	public function actionIndex($token_slid_hash)
	{
		// just experimenting to get things right, piece by piece.
		$association = TokenAssociations::find()
		                                ->where('token_id = :slid_hash', [':slid_hash' => $token_slid_hash])
		                                ->one();

		// if we don't find an association, means this is an unknown token
		// consider doing scan-to-attach if it is not already assigned in the slid_lookup table
		if (!$association) {
			// for now, we just throw an exception until we figure out the basics
			//    and how to handle scan-to-attach.
			// gavgav NOTE: this MUST be removed before we go to production.
			//   we do not want to reveal information to scanner.
			//   if not found, it will fall back to a rendered page, always.
			//   This is TEMPORARY
			\Yii::info('token_slid_hash not found in life_token_associations table: '. $token_slid_hash);
			throw new HttpException(404, 'This SaveLifeID is not active');
		}

		// token must be active to show profile
		if ($association->active == 0) {
			// inactive token.  we could do scan to activate in the future here.
			\Yii::info('token_slid_hash not active: '. $token_slid_hash);
			throw new HttpException(404, 'This SaveLifeID is not active');
		}

		// Patient must be active as well to show profile:
		$attachedPatient = Patient::findOne(['patients_id' => $association->patient_id]);
		if (!$attachedPatient) {
			// attached to invalid user
			\Yii::info('token_slid_hash attached to invalid patient id: token='. $token_slid_hash . ', patient=' . $association->patient_id);
			throw new HttpException(404, 'This SaveLifeID is not active');
		}
		if ($attachedPatient->status != 'active') {
			// attached to inactive user
			\Yii::info('token_slid_hash attached to inactive patient id: token='. $token_slid_hash . ', patient=' . $association->patient_id);
			throw new HttpException(404, 'This SaveLifeID is not active');
		}

		// association found, it is active, it is attached to a valid and active patient, so, show profile:
		unset($_GET['token_slid_hash']);
		$queryToAppend = http_build_query($_GET);
		if (strlen($queryToAppend) > 0) { $queryToAppend = '?'. $queryToAppend; }
                
                $profileUrl = $attachedPatient->getProfileUrl();
                $profileUrl = str_replace('Unknown', $attachedPatient->internal_id, $profileUrl);
		return $this->redirect($profileUrl.$queryToAppend);  // fake positive result, will switch at end.
	}
}
