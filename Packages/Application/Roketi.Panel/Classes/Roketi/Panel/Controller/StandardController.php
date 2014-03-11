<?php
namespace Roketi\Panel\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * Just redirect the user to the dashboard
	 */
	public function indexAction() {
		$this->redirect('dashboard');
	}

	/**
	 * @return void
	 */
	public function dashboardAction() {
		$this->view->assign('foos', array(
			'bar', 'baz'
		));
	}

}