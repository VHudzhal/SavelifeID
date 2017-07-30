<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 07.06.17
 * Time: 15:54
 */

namespace app\components;


use Aws\Credentials\Credentials;
use Aws\Ssm\SsmClient;
use yii\base\Component;

class awsParams extends Component {

	public function getParam($param, $default = null){
		// dev.stripe.secret.key
		$ret = $default;

		$config = [
			'region'       => getenv('BUCKET_IMAGE_REGION'),
			'version'      => 'latest',
		];
		if (($bsecret = getenv('BUCKET_SECRET_KEY')) && ($bkey = getenv('BUCKET_ACCESS_KEY')) ){
			$credentials = new Credentials($bkey, $bsecret);
			$config['credentials'] = $credentials;
		}

		try{
			$client = SsmClient::factory($config);
			$result = (array)$client->getParameters([
				'Names' => [$param], // REQUIRED
	            'WithDecryption' => false,
			]);
			$data = array_pop($result);

			if ($data && isset($data['Parameters']) && isset($data['Parameters'][0]['Value'])){
				$ret = $data['Parameters'][0]['Value'];
			}
		}catch (\Exception $e){}

		return $ret;
	}
}