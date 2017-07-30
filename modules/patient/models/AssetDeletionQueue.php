<?php

namespace app\modules\patient\models;

use app\modules\patient\models\Log\S3DeletionErrorLog;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "life_asset_deletion_queue".
 *
 * @property string $s3url
 * @property string $date_queued
 */
class AssetDeletionQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_asset_deletion_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s3url'], 'required'],
            [['date_queued'], 'safe'],
            [['s3url'], 'string', 'max' => 256],
            [['s3url'], 'unique'],
        ];
    }

	public function behaviors() {
		return [
			[
				'class'              => TimestampBehavior::className(),
				'createdAtAttribute' => 'date_queued',
				'updatedAtAttribute' => 'date_queued',
				'value'              => new Expression( 'NOW()' ),
			],
		];
	}
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            's3url' => 'S3url',
            'date_queued' => 'Date Queued',
        ];
    }

    public function beforeDelete() {
    	if (parent::beforeDelete()) {
		    $config = [
			    'region'       => getenv('BUCKET_IMAGE_REGION'),
			    'version'      => 'latest',
		    ];
		    if (($bsecret = getenv('BUCKET_SECRET_KEY')) && ($bkey = getenv('BUCKET_ACCESS_KEY')) ){
			    $credentials = new Credentials($bkey, $bsecret);
			    $config['credentials'] = $credentials;
		    }

		    $data = explode('://', $this->s3url);
		    if ($data[0] == 's3'){

		    	try{
			        $chains = explode('/', $data[1]);
				    $bucket = $chains[0];
			        unset($chains[0]);
			        $key = implode('/', $chains);

				    $s3 = S3Client::factory($config);
				    $s3->deleteObject([
					    'Bucket'       => $bucket,
					    'Key'          => $key
				    ]);

				    return true;
			    }catch(\Exception $e){
				    (new S3DeletionErrorLog([
				    	's3url' => $this->s3url,
					    'error' => $e->getMessage()
				    ]))->save();
		    		return false;
			    }
		    }

		    return true;
	    }
	    return false;
    }

	public static function add($url){
    	if (!AssetDeletionQueue::findOne(['s3url' => $url])) {
		    $model = new AssetDeletionQueue();
		    $model->s3url = $url;
		    return $model->save();
	    } else {
		    return true;
	    }
    }
}
