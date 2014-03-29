<?php
namespace Roketi\Panel\Controller;

/*                                                                     *
 * This script belongs to the TYPO3 Flow package 'Roketi.Panel'.       *
 *                                                                     *
 *                                                                     */

use TYPO3\Flow\Annotations as Flow;

/**
 * Central login controller
 */
class LoginController extends \TYPO3\Flow\Security\Authentication\Controller\AbstractAuthenticationController {

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
	 * @var \TYPO3\Flow\I18n\Translator
	 * @Flow\Inject
	 */
	protected $translator;

	/**
	 * Render the login form
	 */
	public function indexAction() {
		// well, just render the login form, no more magic in here
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

	/**
	 * Is called if authentication was successful.
	 *
	 * See the implementation in the AbstractAuthenticationController for details!
	 *
	 * @param \TYPO3\Flow\Mvc\ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
	 * @return string
	 */
	protected function onAuthenticationSuccess(\TYPO3\Flow\Mvc\ActionRequest $originalRequest = NULL) {
		// if the login attempt is authenticated, add a success flash message
		$this->addFlashMessage(
			$this->translate(
				'status_login_success',
				'Login'
			)
		);

		// basically redirect to the intercepted requiest if there's one - but never redirect
		// to the login form after successful login as this seems to make no sense.
		if ($originalRequest !== NULL && $originalRequest->getControllerActionName() != 'login') {
			$this->redirectToRequest($originalRequest);
		} else {
			$this->redirect('dashboard', 'Standard');
		}
	}


	/**
	 * Is called if authentication failed.
	 *
	 * See the implementation in the AbstractAuthenticationController for details!
	 *
	 * @param \TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception The exception thrown while the authentication process
	 * @return void
	 */
	protected function onAuthenticationFailure(\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception = NULL) {
		$this->addFlashMessage(
			$this->translate(
				'status_login_failure',
				'Login'
			),
			'',
			'Error'
		);

		$this->redirect('index', 'Login');
	}

	/**
	 * Helper function to translate a given translation ID to the current locale.
	 *
	 * By default, it will look up the label in the Main.xlf file. If you want
	 * to translate a label from another collection, just provide the collection's
	 * name as the second parameter.
	 *
	 * @param string the ID of the translation unit to be looked up
	 * @param string the name of the collection to look up the label, optional, defaults to 'Main'
	 * @return string the localized label or the ID if no matching localization found
	 */
	protected function translate($id, $collectionName = 'Main') {
		return $this->translator->translateById(
			$id,
			array(),
			NULL,
			NULL,
			$collectionName,
			'Roketi.Panel'
		);
	}
}