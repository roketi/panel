<?php
namespace Roketi\Panel\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class StandardController extends BaseController {

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
	}

}