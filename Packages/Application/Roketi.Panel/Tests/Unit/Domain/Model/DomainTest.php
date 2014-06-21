<?php
namespace Roketi\Panel\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use \Roketi\Panel\Domain\Model\Domain;

/**
 * Testcase for Domain
 */
class DomainTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @var Domain
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Domain();

		// we need to manually inject the IDNA converter stuff as we're
		// not running functional tests, but pure unit-tests
		$idnaConvertService = new \Roketi\Panel\Service\IdnaConvertService;
		$idnaConverterImplementation = new \Roketi\Panel\Service\IdnaConvertOriginal();
		$idnaConvertService->injectIdnaConverter($idnaConverterImplementation);
		$this->fixture->injectIdnaConvertService($idnaConvertService);
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function createTimeIsNotNullByDefault() {
		$this->assertInstanceOf('DateTime', $this->fixture->getCreateTime());
	}

	/**
	 * @test
	 */
	public function setNameSetsName() {
		$this->fixture->setName('foobar.com');

		$this->assertEquals(
			'foobar.com',
			$this->fixture->getName()
		);
	}

	/**
	 * @test
	 */
	public function getIdnaNameReturnsSameAsTheDomainNameForDomainWithoutUmlaut() {
		$this->fixture->setName('foobar.com');

		$this->assertEquals(
			'foobar.com',
			$this->fixture->getPunycodeName()
		);
	}

	/**
	 * @test
	 */
	public function getIdnaNameReturnsIdnaNameForDomainWithUmlaut() {
		$this->fixture->setName('grüezi.ch');

		$this->assertEquals(
			'xn--grezi-lva.ch',
			$this->fixture->getPunycodeName()
		);
	}


	/**
	 * @test
	 */
	public function dnsIsDisabledByDefault() {
		$this->assertFalse(
			$this->fixture->getEnableDNS()
		);
	}

	/**
	 * @test
	 */
	public function setEnableDnsSetsEnableDns() {
		$this->fixture->setEnableDNS(TRUE);

		$this->assertTrue(
			$this->fixture->getEnableDNS()
		);
	}

	/**
	 * @test
	 */
	public function setEnableMailServiceIsDisabledByDefault() {
		$this->assertFalse(
			$this->fixture->getEnableMailService()
		);
	}

	/**
	 * @test
	 */
	public function setEnableMailServiceSetsEnableMailService() {
		$this->fixture->setEnableMailService(TRUE);

		$this->assertTrue(
			$this->fixture->getEnableMailService()
		);
	}
}