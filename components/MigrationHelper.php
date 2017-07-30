<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 05.04.17
 * Time: 14:56
 */

namespace app\components;


class MigrationHelper {
	public static function fieldExists($table, $field){
		$query = "
SELECT count(*)
FROM information_schema.columns 
WHERE table_schema = database()
and COLUMN_NAME = '{$field}'
AND table_name = '{$table}';
";
		return (bool)\Yii::$app->db->createCommand($query)->queryScalar();
	}

}