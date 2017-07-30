<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\components;

use app\modules\patient\models\GuestSession as SessionModel;
use Yii;
use yii\base\ErrorHandler;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\db\Connection;
use yii\db\Query;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\Html;
use yii\web\MultiFieldSession;

/**
 * DbSession extends [[Session]] by using database as session data storage.
 *
 * By default, DbSession stores session data in a DB table named 'session'. This table
 * must be pre-created. The table name can be changed by setting [[sessionTable]].
 *
 * The following example shows how you can configure the application to use DbSession:
 * Add the following to your application config under `components`:
 *
 * ```php
 * 'session' => [
 *     'class' => 'yii\web\DbSession',
 *     // 'db' => 'mydb',
 *     // 'sessionTable' => 'my_session',
 * ]
 * ```
 *
 * DbSession extends [[MultiFieldSession]], thus it allows saving extra fields into the [[sessionTable]].
 * Refer to [[MultiFieldSession]] for more details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GuestSession extends MultiFieldSession
{
    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     * After the DbSession object is created, if you want to change this property, you should only assign it
     * with a DB connection object.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'db';
    /**
     * @var string the name of the DB table that stores the session data.
     * The table should be pre-created as follows:
     *
     * ```sql
     * CREATE TABLE session
     * (
     *     id CHAR(40) NOT NULL PRIMARY KEY,
     *     expire INTEGER,
     *     data BLOB
     * )
     * ```
     *
     * where 'BLOB' refers to the BLOB-type of your preferred DBMS. Below are the BLOB type
     * that can be used for some popular DBMS:
     *
     * - MySQL: LONGBLOB
     * - PostgreSQL: BYTEA
     * - MSSQL: BLOB
     *
     * When using DbSession in a production server, we recommend you create a DB index for the 'expire'
     * column in the session table to improve the performance.
     *
     * Note that according to the php.ini setting of `session.hash_function`, you may need to adjust
     * the length of the `id` column. For example, if `session.hash_function=sha256`, you should use
     * length 64 instead of 40.
     */
    public $sessionTable = 'life_guest_session';

    public $sessionCookie = 'gs';
    public $sessionId;


    /**
     * Initializes the DbSession component.
     * This method will initialize the [[db]] property to make sure it refers to a valid DB connection.
     * @throws InvalidConfigException if [[db]] is invalid.
     */
    public function init()
    {
        parent::init();
        $this->sessionId = $this->getId();
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    /**
     * Updates the current session ID with a newly generated one .
     * Please refer to <http://php.net/session_regenerate_id> for more details.
     * @param bool $deleteOldSession Whether to delete the old associated session file or not.
     */
    public function regenerateID($deleteOldSession = false)
    {
        $oldID = $this->getId();

	    $this->setId($this->generateSessionId());

	    if (!empty($oldID)) {
	        $query = new Query();
	        $rows = $query->from($this->sessionTable)
	            ->where(['id' => $oldID])
	            ->createCommand($this->db)
	            ->queryAll();
	        if ($rows) {
	            if ($deleteOldSession) {
	                $this->db->createCommand()
	                    ->update($this->sessionTable, ['id' => $this->sessionId], ['id' => $oldID])
	                    ->execute();
	            } else {
	                foreach ($rows as $row) {
			            $row['id'] = $this->sessionId;
			            $this->db->createCommand()
			                     ->insert($this->sessionTable, $row)
			                     ->execute();
		            }
	            }
	        } else {
	            // shouldn't reach here normally
		        /*
	            $this->db->createCommand()
	                ->insert($this->sessionTable, $this->composeFields($this->sessionId, ''))
	                ->execute();
		        */
	        }
	    }
    }

    /**
     * Session destroy handler.
     * @internal Do not call this method directly.
     * @param string $id session ID
     * @return bool whether session is destroyed successfully
     */
    public function destroySession($id)
    {
        $this->db->createCommand()
            ->delete($this->sessionTable, ['id' => $id])
            ->execute();

        return true;
    }

    /**
     * Session GC (garbage collection) handler.
     * @internal Do not call this method directly.
     * @param int $maxLifetime the number of seconds after which data will be seen as 'garbage' and cleaned up.
     * @return bool whether session is GCed successfully
     */
    public function gcSession($maxLifetime)
    {
        $this->db->createCommand()
            ->delete($this->sessionTable, '[[expire]]<:expire', [':expire' => time()])
            ->execute();

        return true;
    }


	/**
	 * Starts the session.
	 */
	public function open()
	{
		if ($this->getIsActive()) {
			return;
		}

		$this->registerSessionHandler();

		$this->setCookieParamsInternal();

		$this->regenerateID(true);

		if ($this->getIsActive()) {
			Yii::info('Guest session started', __METHOD__);
		} else {
			$error = error_get_last();
			$message = isset($error['message']) ? $error['message'] : 'Failed to start guest session.';
			Yii::error($message, __METHOD__);
		}
	}

	/**
	 * Registers session handler.
	 * @throws \yii\base\InvalidConfigException
	 */
	protected function registerSessionHandler()
	{
		/** hack - garbage collection */
		if (rand(0, 100) <= $this->getGCProbability()) {
			$this->gcSession($this->getTimeout());
		}
	}

	/**
	 * Ends the current session and store session data.
	 */
	public function close()
	{
		if ($this->getIsActive()) {
			$this->setId('');
		}
	}

	/**
	 * Frees all session variables and destroys all data registered to a session.
	 */
	public function destroy()
	{
		if ($this->getIsActive()) {
			$sessionId = $this->sessionId;
			$this->destroySession($this->sessionId);
			$this->close();
			$this->setId($sessionId);
			$this->open();
			$this->setId($sessionId);
		}
	}

	/**
	 * @return bool whether the session has started
	 */
	public function getIsActive()
	{
		return (bool)$this->sessionId;
	}

	/**
	 * Gets the session ID.
	 * This is a wrapper for [PHP session_id()](http://php.net/manual/en/function.session-id.php).
	 * @return string the current session ID
	 */
	public function getId()
	{
		$this->sessionId = $this->sessionId?$this->sessionId:Yii::$app->request->cookies->getValue($this->sessionCookie, null);
		return $this->sessionId;
	}

	/**
	 * Sets the session ID.
	 * This is a wrapper for [PHP session_id()](http://php.net/manual/en/function.session-id.php).
	 * @param string $value the session ID for the current session
	 */
	public function setId($value)
	{
		$this->sessionId = $value;
		Yii::$app->response->cookies->add(new \yii\web\Cookie([
			'name' => $this->sessionCookie,
			'value' => $this->sessionId,
			'expire' => time()+$this->getTimeout(),
		]));
	}

	/**
	 * Gets the name of the current session.
	 * This is a wrapper for [PHP session_name()](http://php.net/manual/en/function.session-name.php).
	 * @return string the current session name
	 */
	public function getName()
	{
		return $this->sessionCookie;
	}

	public function setName($value)
	{
		throw new Exception("Not implemented",500);
	}

	public function getSavePath()
	{
		throw new Exception("Not implemented",500);
	}

	public function setSavePath($value)
	{
		throw new Exception("Not implemented",500);
	}



	/**
	 * Returns the session variable value with the session variable name.
	 * If the session variable does not exist, the `$defaultValue` will be returned.
	 * @param string $key the session variable name
	 * @param mixed $defaultValue the default value to be returned when the session variable does not exist.
	 * @return mixed the session variable value, or $defaultValue if the session variable does not exist.
	 */
	public function get($key, $defaultValue = null)
	{
		$this->open();
		$model = SessionModel::find()->where(['id' => $this->sessionId, 'key' => $key])->andWhere(['>', 'expire', time()])->one();
		/** @var $model SessionModel */
		if ($model) {
			return unserialize(base64_decode($model->data));
		}
		return $defaultValue;
	}

	/**
	 * Adds a session variable.
	 * If the specified name already exists, the old value will be overwritten.
	 * @param string $key session variable name
	 * @param mixed $value session variable value
	 */
	public function set($key, $value, $expire = null)
	{
		$this->open();
		$expire = $expire?$expire:time()+$this->getTimeout();

		$model = $this->getModel($key);
		$model->expire = $expire;
		$model->data   = base64_encode(serialize($value));
		if (!$model->save()){
			throw new \yii\db\Exception(strip_tags(Html::errorSummary($model)));
		}
	}

	/**
	 * Removes a session variable.
	 * @param string $key the name of the session variable to be removed
	 * @return mixed the removed value, null if no such session variable.
	 */
	public function remove($key)
	{
		return SessionModel::deleteAll(['id' => $this->sessionId, 'key' => $key]);
	}

	/**
	 * Removes all session variables
	 */
	public function removeAll()
	{
		$this->open();
		SessionModel::deleteAll(['id' => $this->sessionId]);
	}

	/**
	 * @param mixed $key session variable name
	 * @return bool whether there is the named session variable
	 */
	public function has($key)
	{
		$this->open();
		return (bool)$this->getModel($key, false);
	}

	/**
	 * @param mixed $key session variable name
	 * @return int number of seconds
	 */
	public function getExpire($key)
	{
		$this->open();
		$model = $this->getModel($key, false);
		if ($model){
			return $model->expire - time();
		}
		return 0;
	}



	private function getModel($key, $createIfAbsent = true){
		$model = SessionModel::find()->where(['id' => $this->sessionId, 'key' => $key])->andWhere(['>', 'expire', time()])->one();
		if (!$model && $createIfAbsent){
			SessionModel::deleteAll(['id' => $this->sessionId, 'key' => $key]);
			$model = new SessionModel();
			$model->id = $this->sessionId;
			$model->key = $key;
		}
		return $model;
	}

	private function generateSessionId(){
		$id = Yii::$app->security->generateRandomString(40);
		if (SessionModel::findOne(['id' => $id])){
			$id = $this->generateSessionId();
		}
		return $id;
	}

	private function setCookieParamsInternal()
	{
		$data = $this->getCookieParams();
		if (isset($data['lifetime'], $data['path'], $data['domain'], $data['secure'], $data['httponly'])) {
			session_set_cookie_params($data['lifetime'], $data['path'], $data['domain'], $data['secure'], $data['httponly']);
		} else {
			throw new InvalidParamException('Please make sure cookieParams contains these elements: lifetime, path, domain, secure and httponly.');
		}
	}


}
