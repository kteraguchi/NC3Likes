<?php
/**
 * BbsPosts Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('LikesAppController', 'Likes.Controller');

/**
 * Bbses Controller
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Bbses\Controller
 */
class LikesController extends LikesAppController {

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'Likes.Like',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsFrame',
		'NetCommons.NetCommonsWorkflow',
		'NetCommons.NetCommonsRoomRole' => array(
			//コンテンツの権限設定
			//'allowedActions' => array(
			//	'contentCreatable' => array('add', 'reply', 'edit', 'delete'),
			//	'bbsPostCreatable' => array('add', 'reply', 'edit', 'delete')
			//),
		),
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('download');
	}

/**
 * like
 *
 * @return void
 */
	public function like() {
		if (! $this->request->isPost()) {
			$this->_throwBadRequest();
			return;
		}

		if ($this->Like->existsLike($this->data['Like']['content_key'], (int)$this->Auth->user('id'))) {
			if (! $this->request->is('ajax')) {
				$this->redirect($this->request->referer());
			}
			return;
		}

		$data = $this->data;
		$data['Like']['user_id'] = (int)$this->Auth->user('id');

		$this->Like->setDataSource('master');
		$this->Like->saveLike($data);
		if ($this->handleValidationError($this->Like->validationErrors)) {
			if (! $this->request->is('ajax')) {
				$this->redirect($this->request->referer());
			}
			return;
		}

		$this->_throwBadRequest();
	}
}
