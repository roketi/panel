<?php
namespace Roketi\Panel\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

/**
 * Testcase for Log entry
 */
class LogEntryTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/*
	 * @var \Roketi\Panel\Domain\Model\LogEntry
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Roketi\Panel\Domain\Model\LogEntry;
	}

	/**
	 * @test
	 */
	public function setTimeStampSetsTimeStamp() {
		$timestamp = new \DateTime();
		$this->fixture->setTimeStamp($timestamp);

		$this->assertSame(
			$timestamp,
			$this->fixture->getTimeStamp()
		);
	}

	/**
	 * @test
	 */
	public function setAccountSetsAccount() {
		$account = new \TYPO3\Flow\Security\Account();
		$this->fixture->setAccount($account);

		$this->assertSame(
			$account,
			$this->fixture->getAccount()
		);
	}

	/**
	 * @test
	 */
	public function setRemoteIpSetsRemoteIp() {
		$this->fixture->setRemoteIp('10.0.0.99');

		$this->assertEquals(
			'10.0.0.99',
			$this->fixture->getRemoteIp()
		);
	}

	/**
	 * @test
	 */
	public function setComponentSetsComponent() {
		$this->fixture->setComponent('Test');

		$this->assertEquals(
			'Test',
			$this->fixture->getComponent()
		);
	}

	/**
	 * @test
	 */
	public function setActionSetsAction() {
		$this->fixture->setAction('foobar');

		$this->assertEquals(
			'foobar',
			$this->fixture->getAction()
		);
	}
}