<?php
namespace Roketi\Panel\Domain\Validator;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;


class DomainNameValidator extends \TYPO3\Flow\Validation\Validator\AbstractValidator {
	/**
	 * Whether the silent mode should be active, default to FALSE
	 * @var boolean
	 */
	protected $isSilentModeActive = FALSE;

	/**
	 * @var \TYPO3\Flow\I18n\Translator
	 * @Flow\Inject
	 */
	protected $translator;

	/**
	 * The IDNA / Punycode representation of the domain name to check
	 *
	 * @var string
	 */
	protected $domainNameToCheck;

	/**
	 * @var \Roketi\Panel\Service\IdnaConvertService
	 */
	protected $idnaConvertService;

	public function enableSilentMode() {
		$this->isSilentModeActive = TRUE;
	}

	/**
	 * Injects the IDNA domain name converter instance
	 */
	public function injectIdnaConvertService(\Roketi\Panel\Service\IdnaConvertService $idnaConvertService) {
		$this->idnaConvertService = $idnaConvertService;
	}

	/**
	 * Checks a given Domain Name to be syntactically correct regarding the naming rules
	 * in the relevant RFCs.
	 *
	 * @param string $domainName the domain name to validate
	 * @return bool the result of the validation, TRUE if all is fine, FALSE otherwise
	 */
	protected function isValid($domainName) {
		$this->domainNameToCheck = $this->idnaConvertService->encodeUmlautDomainName($domainName);

		if (
			$this->checkForValidNumberOfLabels()
			&& $this->checkForValidLengthOfSingleLabels()
			&& $this->checkLength()
			&& $this->checkForAtLeastOneDot()
			&& $this->checkForAllowedCharacters()
			&& $this->checkForNumberOnlyLabels()
			&& $this->checkForDashesAtBeginEndOfLabels()
		) {
			// all seems to be fine
			return TRUE;
		} else {
			// TODO: Find a nicer solution. Currently the translator cannot be injected properly during unit-tests
			if ($this->isSilentModeActive === TRUE) {
				$this->addError('invalid domain name', 1409169479);
			} else {
				$this->addError(
					$this->translator->translateById(
						'message.error_invalid_domain_name',
						array(),
						NULL,
						NULL,
						'Domain',
						'Roketi.Panel'
					),
					1403357765
				);
			}
			return FALSE;
		}

	}

	/**
	 * Checks if there are more than 127 parts within that domain name, more are
	 * not allowed.
	 *
	 * @see RFC1035
	 * @return bool
	 */
	private function checkForValidNumberOfLabels() {
		$labels = explode('.', $this->domainNameToCheck);

		if (count($labels) > 127) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	private function checkForValidLengthOfSingleLabels() {
		$labels = explode('.', $this->domainNameToCheck);

		foreach ($labels as $label) {
			if (strlen($label) > 63) {
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * Check if there are invalid characters within the domain name. Allowed characters are:
	 * - a-z
	 * - A-Z
	 * - 0-9
	 * - the hyphen "-"
	 *
	 * @return bool
	 */
	private function checkForAllowedCharacters() {
		return (preg_match(
			'/^([a-zA-Z0-9\-\.])+$/',
			$this->domainNameToCheck
		) === 1);
	}

	/**
	 * Checks if there are only numbers within a domain name label
	 *
	 * @return bool
	 */
	private function checkForNumberOnlyLabels() {
		$labels = explode('.', $this->domainNameToCheck);

		foreach ($labels as $label) {
			if (preg_match('/^([0-9])+$/', $label) === 1) {
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * Checks whether there is a label that either starts or ends with a "-" which
	 * is not allowed per definition.
	 *
	 * @see RFC1035
	 * @return boolean
	 */
	private function checkForDashesAtBeginEndOfLabels() {
		$labels = explode('.', $this->domainNameToCheck);

		foreach ($labels as $label) {
			if ((preg_match('/^\-/', $label) === 1)
				|| (preg_match('/\-$/', $label) === 1)) {
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * Checks if there's at least one single dot within the given domain name.
	 *
	 * @return bool
	 */
	private	function checkForAtLeastOneDot() {
		return (strpos(
			$this->domainNameToCheck,
			'.'
		) > 0);
	}

	/**
	 * Checks if the overall length is not more than 253 characters long
	 *
	 * @see RFC1035
	 * @return bool
	 */
	private function checkLength() {
		return (strlen($this->domainNameToCheck) <= 253);
	}
}