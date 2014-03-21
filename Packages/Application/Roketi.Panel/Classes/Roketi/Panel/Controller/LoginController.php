<?php
namespace Roketi\Panel\Controller;

use TYPO3\Flow\Annotations as Flow;

/**
 * Central login controller
 */
class LoginController extends BaseController {

	/**
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 * @Flow\Inject
	 */
	protected $authenticationManager;

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
	 * Render the login form
	 */
	public function indexAction() {
		// well, just render the login form, no more magic in here
	}

	/**
	 * Tries to authenticate the login credentials. If the authentication was
	 * successful, redirect to the restricted area. Otherwise redirect back
	 * to the login form with an error.
	 *
	 * @throws \TYPO3\Flow\Security\Exception\AuthenticationRequiredException
	 * @return void
	 */
	public function authenticateAction() {
		try {
			// try to authenticate the login attempt
			$this->authenticationManager->authenticate();

			// if the login attempt is authenticated, add a success flash message
			$this->addFlashMessage(
				$this->translate(
					'status_login_success',
					'Login'
				)
			);

			// redirect to the restricted area
			$this->redirect('dashboard', 'Standard');
		} catch (\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception) {
			// if the login attempt is not authenticated, add an error flash message
			$this->addFlashMessage(
				$this->translate(
					'status_login_failure',
					'Login'
				),
				'',
				'Error'
			);

			// redirect back to the login form
			$this->redirect(
				'index',
				'Login'
			);
		}
	}

	/**
	 * Logout the user and redirect back to the login form.
	 *
	 * @return void
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		$this->addFlashMessage(
			$this->translate(
				'status_logout_success',
				'Login'
			)
		);
		$this->redirect('index', 'Login');
	}
}