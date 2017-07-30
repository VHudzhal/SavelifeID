<?php

namespace app\modules\patient\models;

use app\components\Helper;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use Yii;

/**
 * This is the model class for table "life_patient_files".
 *
 * @property int $patient_files_id
 * @property string $internal_id
 * @property int $practice_id
 * @property string $file_type
 * @property string $file_name
 * @property string $file_extension
 * @property string $file_description
 * @property string $file_date
 * @property int $display
 *
 * @property Patient $patient
 */
class PatientFiles extends \yii\db\ActiveRecord
{
	const TYPE_EKG                 = 'EKG';
	const TYPE_INSURANCE           = 'Insurance';
	const TYPE_ADVANCED_DIRECTIVE  = 'Advanced Directive';
	const TYPE_OTHER               = 'Other File';

	const PROTOCOL_S3 = 's3';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'life_patient_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'practice_id', 'file_type', 'file_name', 'file_extension', 'file_date', 'display'], 'required'],
	        [['file_description'], 'default', 'value' => ''],
            [['practice_id', 'display'], 'integer'],
            [['file_date'], 'safe'],
            [['internal_id'], 'string', 'max' => 50],
            [['file_name'], 'string', 'max' => 100],
            [['file_extension'], 'string', 'max' => 10],
            [['file_description'], 'string', 'max' => 255],
	        [['file_type'], 'in', 'range' => [PatientFiles::TYPE_EKG, PatientFiles::TYPE_ADVANCED_DIRECTIVE, PatientFiles::TYPE_OTHER]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'patient_files_id' => 'Patient Files ID',
            'internal_id' => 'Internal ID',
            'practice_id' => 'Practice ID',
            'file_type' => 'File Type',
            'file_name' => 'File Name',
            'file_extension' => 'File Extension',
            'file_description' => 'File Description',
            'file_date' => 'File Date',
            'display' => 'Display',
        ];
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
    public function getPatient(){
	    return $this->hasOne(Patient::className(), ['internal_id' => 'internal_id']);
    }

    public function getHref(){
        $filename = implode('.', [$this->file_name, $this->file_extension]);

	    $signedUrl = false;
	    try {
		    $key = Helper::getS3BucketRoot().\Yii::$app->patient->internal_id.'/<type>/'.$filename;
		    switch($this->file_type){
			    case self::TYPE_ADVANCED_DIRECTIVE:
				    $key = str_replace('<type>', 'ad', $key);
				    break;
			    case self::TYPE_EKG:
				    $key = str_replace('<type>', 'ekg', $key);
				    break;
			    case self::TYPE_INSURANCE:
				    $key = str_replace('<type>', 'insurance', $key);
				    break;
			    case self::TYPE_OTHER:
				    $key = str_replace('<type>', 'other', $key);
				    break;
			    default:
				    $key = str_replace('<type>', 'other', $key);
		    }

		    $config = [
			    'region'       => getenv('BUCKET_IMAGE_REGION'),
			    'version'      => 'latest',
		    ];
		    if (($bsecret = getenv('BUCKET_SECRET_KEY')) && ($bkey = getenv('BUCKET_ACCESS_KEY')) ){
			    $credentials = new Credentials($bkey, $bsecret);
			    $config['credentials'] = $credentials;
		    }

		    $s3 = S3Client::factory($config);

		    $result = $s3->doesObjectExist( getenv('BUCKET_IMAGE'), $key );

		    if ($result) {
			    $command   = $s3->getCommand( 'GetObject', array(
				    'Bucket'                     => getenv( 'BUCKET_IMAGE' ),
				    'Key'                        => $key,
				    'ContentType'                => mimetype_from_filename( basename( $key ) ),
				    'ResponseContentDisposition' => 'inline; filename="' . basename( $key ) . '"'
			    ) );
			    $request   = $s3->createPresignedRequest( $command, "+20 minutes" );
			    $signedUrl = (string) $request->getUri();
		    }
	    } catch (\Exception $e){}

	    if ($signedUrl){
		    return $signedUrl;
	    }

        $profileHost = getenv('PROFILE_HOST');
        if ($profileHost) $profileHost = 'https://'.$profileHost;
        else $profileHost = 'https://portal.savelifeid.com';
        
    	switch($this->file_type){
            case self::TYPE_ADVANCED_DIRECTIVE:
                return $profileHost.'/assets/profiles/files/'.$filename;
                break;
            case self::TYPE_EKG:
                return $profileHost.'/assets/profiles/ekg/'.$filename;
                break;
            case self::TYPE_INSURANCE:
                return $profileHost.'/assets/profiles/insurance/'.$filename;
                break;
            case self::TYPE_OTHER:
                return $profileHost.'/assets/profiles/files/'.$filename;
                break;
            default:
                return false;
        }
    }
}
