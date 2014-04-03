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
class LogEntry {

	/**
	 * @var \DateTime
	 */
	protected $timeStamp;

	/**
	 * @var \TYPO3\Flow\Security\Account,
	 * @ORM\ManyToOne()
	 */
	protected $account;

	/**
	 * @var string,
	 */
	protected $remoteIp;

	/**
	 * @var string,
	 */
	protected $component;

	/**
	 * @var string
	 */
	protected $action;


	/**
	 * @return \DateTime,
	 */
	public function getTimeStamp() {
		return $this->timeStamp;
	}

	/**
	 * @param \DateTime $timeStamp
	 * @return void
	 */
	public function setTimeStamp($timeStamp) {
		$this->timeStamp = $timeStamp;
	}

	/**
	 * @return \TYPO3\Flow\Security\Account,
	 */
	public function getAccount() {
		return $this->account;
	}

	/**
	 * @param \TYPO3\Flow\Security\Account $account
	 * @return void
	 */
	public function setAccount($account) {
		$this->account = $account;
	}

	/**
	 * @return string,
	 */
	public function getRemoteIp() {
		return $this->remoteIp;
	}

	/**
	 * @param string $remoteIp
	 * @return void
	 */
	public function setRemoteIp($remoteIp) {
		$this->remoteIp = $remoteIp;
	}

	/**
	 * @return string,
	 */
	public function getComponent() {
		return $this->component;
	}

	/**
	 * @param string $component
	 * @return void
	 */
	public function setComponent($component) {
		$this->component = $component;
	}

	/**
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @param string $action
	 * @return void
	 */
	public function setAction($action) {
		$this->action = $action;
	}

}