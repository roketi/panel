<?php
namespace Roketi\Panel\Controller;

/*                                                                     *
 * This script belongs to the TYPO3 Flow package 'Roketi.Panel'.       *
 *                                                                     *
 *                                                                     */

use TYPO3\Flow\Annotations as Flow;

class BaseController extends \TYPO3\Flow\Mvc\Controller\ActionController {
	/**
	 * @var \TYPO3\Flow\I18n\Detector
	 * @Flow\Inject
	 */
	protected $localeDetector;

	/**
	 * @var \TYPO3\Flow\I18n\Service
	 * @Flow\Inject
	 */
	protected $l18nService;

	/**
	 * @var \TYPO3\Flow\I18n\Locale
	 */
	protected $locale;

	/**
	 * @var \TYPO3\Flow\I18n\Translator
	 * @Flow\Inject
	 */
	protected $translator;

	/**
	 * @var \TYPO3\Flow\Property\PropertyMapper
	 * @Flow\Inject
	 */
	protected $propertyMapper;

	/**
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 * @Flow\Inject
	 */
	protected $persistenceManager;

	/**
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 * @FLOW\Inject
	 */
	protected $authenticationManager;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * @var \TYPO3\Flow\Security\Account()
	 */
	protected $account;

	/**
	 * Initializes some basic stuff that will basically be needed for each and
	 * every action that is executed later on.
	 */
	public function initializeAction() {
		// get the account of the authenticated user
		$this->account = $this->securityContext->getAccount();

		// set the locale
		$this->locale = $this->localeDetector->detectLocaleFromLocaleTag(
			$this->settings['defaultLanguage']
		);

		if ($this->l18nService->getConfiguration()->getCurrentLocale() !== $this->locale) {
			$this->l18nService->getConfiguration()->setCurrentLocale($this->locale);
		}
	}

	/**
	 * Initializes the view and assigns stuff like the locale and the language-navigation
	 * options to the view, so they are available in every action's view.
	 *
	 * @param \TYPO3\Flow\Mvc\View\ViewInterface $view
	 * @return void
	 */
	protected function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view) {
		$view->assign('account', $this->account);
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

	/**
	 * Overwrite the function of the action controller class to remove the
	 * generic flash message which is added by the framework.
	 *
	 * @return bool
	 */
	protected function getErrorFlashMessage() {
		return FALSE;
	}
}