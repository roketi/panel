<?php
namespace Roketi\Panel\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Domain {

	/**
	 * @var \Roketi\Panel\Service\IdnaConvertService
	 */
	protected $idnaConvertService;

	/**
	 * The domain name.
	 *
	 * Has to be unique in the system, therefore this is marked as an identity property. We want to have the possibility
	 * to change the name later on, therefore it is not made the object persistence identifier for Doctrine.
	 *
	 * @var string
	 * @Flow\Validate(type="\Roketi\Panel\Domain\Validator\DomainNameValidator")
	 */
	protected $name;

	/**
	 * The ASCII-only version of this domain name.
	 *
	 * @var string
	 * @Flow\Identity
	 */
	protected $punycodeName;

	/**
	 * @var boolean
	 */
	protected $enableDNS = FALSE;

	/**
	 * @var boolean
	 */
	protected $enableMailService = FALSE;

	/**
	 * @var \DateTime
	 */
	protected $createTime;

	/**
	 * Injects the IDNA domain name converter instance
	 */
	public function injectIdnaConvertService(\Roketi\Panel\Service\IdnaConvertService $idnaConvertService) {
		$this->idnaConvertService = $idnaConvertService;
	}

	/**
	 * The constructor
	 * Used to set some default data for new objects.
	 */
	public function __construct() {
		$this->createTime = new \DateTime();
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the original domain name - may include umlauts in the domain name.
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;

		$this->punycodeName = $this->idnaConvertService->encodeUmlautDomainName($name);
	}

	/**
	 * Returns the IDNA-Version of the domain name (the technically usable domain-name
	 * with masked umlaut characters).
	 *
	 * Returns the same as the regular domain name if there's no difference (i.e. no
	 * umlaut in the domain name).
	 *
	 * @return string
	 */
	public function getPunycodeName() {
		return $this->punycodeName;
	}

	/**
	 * @return boolean
	 */
	public function getEnableDNS() {
		return $this->enableDNS;
	}

	/**
	 * @param boolean $enableDNS
	 * @return void
	 */
	public function setEnableDNS($enableDNS) {
		$this->enableDNS = $enableDNS;
	}

	/**
	 * @return boolean
	 */
	public function getEnableMailService() {
		return $this->enableMailService;
	}

	/**
	 * @param boolean $enableMailService
	 * @return void
	 */
	public function setEnableMailService($enableMailService) {
		$this->enableMailService = $enableMailService;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreateTime() {
		return $this->createTime;
	}

}