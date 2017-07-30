<?php
/**
 * Created by PhpStorm.
 * User: miloslawsky
 * Date: 09.03.17
 * Time: 17:30
 */

namespace app\components;


use app\models\Maintenance;
use app\modules\patient\models\Patient;
use yii\helpers\Html;

class Controller extends \yii\web\Controller {
	const THEME_DEFAULT  = 'default';
	const THEME_EMR      = 'emr';
	const THEME_PERSONAL = 'personal';

	public function beforeAction($action) {
		if (\Yii::$app->isMaintenance) {
			return parent::beforeAction($action);
		} else {
			if (parent::beforeAction($action)) {
				$theme = self::THEME_DEFAULT;
				$this->setTheme($theme);

				if (!\Yii::$app->patient->isGuest){
					if (\Yii::$app->patient->isActivated) {
						if (\Yii::$app->patient->status == Patient::STATUS_CANCEL) {
							$menu = [
								['href' => '/subscriber-home', 'title' => 'Subscriber Home', 'mobile-title' => '<i class="glyphicon glyphicon-home"></i>', 'class' => 'title-mobile-icon'],
								['href' => '/subscriber-home/account', 'title' => 'Account Information', 'mobile-title' => 'Account', 'item-hrefs' => ['/subscriber-home/account', '/subscriber-home/account-cancel', '/subscriber-home/account-status', '/subscriber-home/account-security', '/subscriber-home/account-support']],
								['href' => '/subscriber-home/overdue', 'title' => 'Full Medical Info', 'mobile-title' => 'MedInfo', 'class' => 'emodal-ajax'],
								['href' => '/subscriber-home/overdue', 'title' => 'Emergency Profile', 'mobile-title' => 'Profile', 'class' => 'emodal-ajax'],
							];
						} else {
							$menu = [
								['href' => '/subscriber-home', 'title' => 'Subscriber Home', 'mobile-title' => '<i class="glyphicon glyphicon-home"></i>', 'class' => 'title-mobile-icon'],
								['href' => '/subscriber-home/account', 'title' => 'Account Information', 'mobile-title' => 'Account', 'item-hrefs' => ['/subscriber-home/account', '/subscriber-home/account-cancel', '/subscriber-home/account-status', '/subscriber-home/account-security', '/subscriber-home/account-support']],
								['href' => '/subscriber-home/record', 'title' => 'Full Medical Info', 'mobile-title' => 'MedInfo'],
								['href' => \Yii::$app->patient->model->getProfileUrl(), 'title' => 'Emergency Profile', 'target' => '_blank', 'mobile-title' => 'Profile'],
							];
						}
					} else {
						$menu = [
							['href' => '/', 'title' => 'Home'],
							['href' => '/about-us', 'title' => 'About Us'],
							['href' => '/faq', 'title' => 'FAQ'],
							false,
							['href' => '/logout', 'title' => 'Sign Out'],
						];
					}
				} else {
					$menu = array(
						['href' => '/', 'title' => 'Home'],
						['href' => '/about-us', 'title' =>'About Us'],
						['href' => '/faq', 'title' =>'FAQ'],
						false,
						['href' => '#', 'title' => 'Sign In', 'data-toggle'=>'modal', 'data-target' => '#signIN'],
						['href' => '/register', 'title' => 'Register', 'class' => 'btn-success']
					);
				}
				$this->view->params['menu'] = $this->getMenuHtml($menu);

				if (Maintenance::isActiveAny()){
					$this->layout = '//maintenance';
					if (!\Yii::$app->patient->isGuest && !\Yii::$app->patient->is_admin){
						\Yii::$app->patient->logout();
						$this->redirect('/');
					}

					if (( !\Yii::$app->request->isPost && !in_array($action->id, ['login', 'logout', 'error']) && !($this instanceof \app\modules\admin\components\Controller))){
						\Yii::$app->isMaintenance = true;
						\Yii::$app->isDbFree = false;
						echo \Yii::$app->runAction('site/maintenance');
						\Yii::$app->end();
					}
				}

				return true;  // or false if needed
			} else {
				return false;
			}
		}
	}

	public function getMenuHtml($menu, $layout = 'btn-group'){
		return $this->renderPartial('@app/themes/default/layouts/menu/'.$layout, [
			'menu' => $menu
		]);
	}

	public function setTheme($theme){
		\Yii::$app->view->theme = new \yii\base\Theme([
			'pathMap' => [
				'@app/views' => [
					'@app/themes/'.$theme,
				],
			],
			'baseUrl' => '@web',
		]);
	}

	public function redirectToSoonPage(){
		if ($this->id != 'site' && !\Yii::$app->request->isAjax){
			$this->redirect('/soon-self-registered');
			\Yii::$app->end();
		}
	}
}