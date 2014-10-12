<?php
namespace Roketi\Panel\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * General purpose command controller to prepare the installed Roketi Panel
 *
 * @Flow\Scope("singleton")
 */

class SetupCommandController extends \TYPO3\Flow\Cli\CommandController {
	/**
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;

	/**
	 * @var \TYPO3\Flow\Security\AccountFactory
	 * @Flow\Inject
	 */
	protected $accountFactory;

	/**
	 * Adds a new account to the system.
	 *
	 * @param string $username The username of the new administrator
	 * @param string $password The password of the new administrator
	 */
	public function createAdminUserCommand($username = '', $password = '') {
		// check if user + password are not empty
		if ($username == '' || $password == '') {
			// add a console output
			$this->outputLine('Either username or password missing, cannot continue.');
			return 1;
		}

		// let's create the user
		$account = $this->accountFactory->createAccountWithPassword(
			$username,
			$password,
			array(
				'Roketi.Panel:Administrator'
			)
		);
		$this->accountRepository->add($account);

		$this->outputLine('User ' . $username . ' created successfully.');
	}
}