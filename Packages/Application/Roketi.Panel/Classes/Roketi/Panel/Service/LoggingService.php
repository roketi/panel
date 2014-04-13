<?php
namespace Roketi\Panel\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Rokei.Panel".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class LoggingService {

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @var \TYPO3\Flow\Core\Bootstrap
	 * @Flow\Inject
	 */
	protected $bootstrap;

	/**
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $context;

	/**
	 * @var \Roketi\Panel\Domain\Repository\LogEntryRepository
	 * @Flow\Inject
	 */
	protected $logEntryRepository;

	/**
	 * @var boolean
	 */
	protected $doLogTheCurrentUser;


	/**
	 * Logs a performed action including the currently logged in user
	 *
	 * @param string $component
	 * @param string $action
	 */
	public function log($component, $action) {
		$this->doLogTheCurrentUser = TRUE;

		$this->writeLogEntry($component, $action);
	}

	/**
	 * Logs a performed action, but omits the currently logged in user
	 * e.g. because it's an action performed anonymously like a failed
	 * login attempts that happens while no user is logged in.
	 *
	 * @param string $component
	 * @param string $action
	 */
	public function logWithoutUser($component, $action) {
		$this->doLogTheCurrentUser = FALSE;

		$this->writeLogEntry($component, $action);
	}

	/**
	 * Stores log entries for given actions.
	 *
	 * @param string $component of the whole application
	 * @param string $action the performed action to be logged
	 */
	protected function writeLogEntry($component, $action) {
		$entry = new \Roketi\Panel\Domain\Model\LogEntry();

		$entry->setTimeStamp(new \DateTime());
		$entry->setAction($action);
		$entry->setComponent($component);

		if ($this->doLogTheCurrentUser === TRUE) {
			$account = $this->context->getAccount();
			$entry->setAccount($account);
		} else {
			$entry->unsetAccount();
		}

		// fiddle out the IP of the client
		$requestHandler = $this->bootstrap->getActiveRequestHandler();
		if ($requestHandler instanceof \TYPO3\Flow\Http\HttpRequestHandlerInterface) {
			$ip = $requestHandler->getHttpRequest()->getClientIPAddress();
		} else {
			$ip = '';
		}
		$entry->setRemoteIp($ip);

		$this->logEntryRepository->add($entry);
		$this->persistenceManager->persistAll();
	}
}