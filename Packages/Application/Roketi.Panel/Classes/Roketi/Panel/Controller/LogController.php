<?php
namespace Roketi\Panel\Controller;

/*                                                                     *
 * This script belongs to the TYPO3 Flow package 'Roketi.Panel'.       *
 *                                                                     *
 *                                                                     */

use TYPO3\Flow\Annotations as Flow;

/**
 * Central log (viewer) controller
 */
class LogController extends BaseController {

	/**
	 * @var \Roketi\Panel\Domain\Repository\LogEntryRepository
	 * @Flow\Inject
	 */
	protected $logEntryRepository;

	/**
	 * Render the last log entries
	 */
	public function indexAction() {
		$this->view->assign(
			'entries',
			$this->logEntryRepository->findLatest()
		);
	}
}