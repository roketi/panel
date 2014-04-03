<?php
namespace Roketi\Panel\Aspects;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Rokei.Panel".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 * @Flow\Aspect
 */
class LoginAspect {
	/**
	 * @var \Roketi\Panel\Service\LoggingService
	 * @Flow\Inject
	 */
	protected $loggingService;

	/**
	 * Logs each successful login
	 *
	 * @Flow\Before("method(Roketi\Panel\Controller\LoginController->onAuthenticationSuccess())")
	 * @return mixed
	 */
	public function logSuccessfulLogin() {
		$this->loggingService->log(
			'authentication',
			'user_logged_in'
		);
	}

	/**
	 * Logs each failed login attempt
	 *
	 * @Flow\Before("method(Roketi\Panel\Controller\LoginController->onAuthenticationFailure())")
	 * @return mixed
	 */
	public function logFailedLogin() {
		$this->loggingService->logWithoutUser(
			'authentication',
			'user_login_failed'
		);
	}

	/**
	 * Logs each logout
	 *
	 * @Flow\Before("method(Roketi\Panel\Controller\LoginController->logoutAction())")
	 * @return mixed
	 */
	public function logLogout() {
		$this->loggingService->log(
			'authentication',
			'user_logged_out'
		);
	}
}