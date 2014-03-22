<?php
namespace Roketi\Panel\Aspects;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Rokei.Panel".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Aop\JoinPointInterface;

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
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return mixed
	 */
	public function logSuccessfulLogin(\TYPO3\Flow\AOP\JoinPointInterface $joinPoint) {
		$this->loggingService->log(
			'authentication',
			'user_logged_in'
		);
	}

	/**
	 * Logs each failed login attempt
	 *
	 * @Flow\Before("method(Roketi\Panel\Controller\LoginController->onAuthenticationFailure())")
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return mixed
	 */
	public function logFailedLogin(\TYPO3\Flow\AOP\JoinPointInterface $joinPoint) {
		$this->loggingService->logWithoutUser(
			'authentication',
			'user_login_failed'
		);
	}

	/**
	 * Logs each logout
	 *
	 * @Flow\Before("method(Roketi\Panel\Controller\LoginController->logoutAction())")
	 * @param \TYPO3\Flow\Aop\JoinPointInterface $joinPoint The current join point
	 * @return mixed
	 */
	public function logLogout(\TYPO3\Flow\AOP\JoinPointInterface $joinPoint) {
		$this->loggingService->log(
			'authentication',
			'user_logged_out'
		);
	}
}