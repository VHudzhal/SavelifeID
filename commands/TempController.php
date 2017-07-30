<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\modules\patient\models\AssetDeletionQueue;
use app\modules\patient\models\Patient;
use yii\console\Controller;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TempController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionProcessStripe()
    {
    	Patient::updateAll(['stripe_customer' => '', 'stripe_subscription_id' => '', 'stripe_subscription_type' => '']);
    	$query = "
SELECT patients_id FROM life_patients WHERE email IN (
SELECT email
from life_patients
GROUP BY email
HAVING count(email) = 1
)";
    	$ids = \Yii::$app->db->createCommand($query)->queryAll();

	    $key  = \Yii::$app->stripe->getKey();
	    if ( $key ) {
		    \Stripe\Stripe::setApiKey( $key );

	        foreach ($ids as $one){
	            $model = Patient::findOne(['patients_id' => $one['patients_id']]);
	            echo("Processing {$model->email}... ");
			    try {

				    // 1) Create customer
				    $customer = \Stripe\Customer::create([
				    	'email' => $model->email,
					    'description' => $model->first_name.' '.$model->last_name.' (#'.$model->patients_id.')'
				    ]);

				    if ($customer){
				    	$model->stripe_customer = $customer->id;
				    	$model->save();
					    echo(' customer created... ');

					    // 2) create card
					    $token = \Stripe\Token::create([
						    "card" => [
							    "number" => '4242424242424242',
							    "exp_month" => '12',
							    "exp_year" => '2021',
							    "cvc" => '123'
						    ]
					    ]);

					    if ($token->id) {
						    // Add a new card to the customer
						    $card = $customer->sources->create(['source' => $token->id]);

						    // Set the new card as the customers default card
						    $customer->default_source = $card->id;
						    $customer->save();
						    echo(' card added... ');
					    } else {
						    throw new \Exception("Wrong card data given.", 500);
					    }

					    if ($model->status == Patient::STATUS_ACTIVE){
					    	// 3) Add subscription
						    $subscription = \Stripe\Subscription::create(array(
							    "customer" => $customer->id,
							    "plan" => 'SaveLifeMonthly',
							    "prorate" => false
						    ));
						    $model->stripe_subscription_id = $subscription->id;
						    $model->stripe_subscription_type = 'Monthly';
						    $model->save();
						    echo(' subscription added... ');
					    }
				    }

			    } catch(\Exception $e){
				    echo("\n\n");
			    	echo(' ERROR! '.$e->getMessage());
				    echo("\n\n");
			    }
		        echo "\n";
		    }
	    } else {
	    	echo implode(', ', \Yii::$app->stripe->getErrors());
	    }
	    echo "All done!\n";
    }
}
