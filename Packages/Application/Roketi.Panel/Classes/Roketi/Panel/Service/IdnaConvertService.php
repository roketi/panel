<?php
namespace Roketi\Panel\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class IdnaConvertService {

	/**
	 * The IDNA Converter instance.
	 */
	protected $idnaConverter;

	/**
	 * Injects the concrete implementation of the used IDNA domain name conversion service.
	 *
	 * @var IdnaConvertOriginal
	 */
	public function injectIdnaConverter(IdnaConvertOriginal $idnaConverter) {
		$this->idnaConverter = $idnaConverter;
	}

	/**
	 * Encodes a domain name with/without umlauts to it's punycode equivalent.
	 */
	public function encodeUmlautDomainName($domainNameWithUmlauts) {
		return $this->idnaConverter->encode($domainNameWithUmlauts);
	}
}