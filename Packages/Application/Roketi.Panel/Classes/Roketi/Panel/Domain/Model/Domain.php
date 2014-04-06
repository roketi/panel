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
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $idnaName;

	/**
	 * @var boolean
	 */
	protected $enableDNS;

	/**
	 * @var boolean
	 */
	protected $enableMailService;

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

		$this->enableDNS = FALSE;
		$this->enableMailService = FALSE;
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

		$this->idnaName = $this->idnaConvertService->encodeUmlautDomainName($name);
	}

	/**
	 * Returns the IDNA-Version of the domain name (the technically usable domain-name
	 * with masked umlaut characters).
	 *
	 * Returns the same as the regular domain name if there's no difference (e.g. no
	 * umlaut in the domain name)
	 */
	public function getIdnaName() {
		return $this->idnaName;
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

	/**
	 * @param \DateTime $createTime
	 * @return void
	 */
	public function setCreateTime($createTime) {
		$this->createTime = $createTime;
	}

}