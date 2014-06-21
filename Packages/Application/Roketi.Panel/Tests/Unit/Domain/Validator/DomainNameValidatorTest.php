<?php
namespace Roketi\Panel\Tests\Unit\Domain\Validator;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use \Roketi\Panel\Domain\Model\Validator;
use Roketi\Panel\Domain\Validator\DomainNameValidator;

/**
 * Testcase for the Domain Name Validator
 */
class DomainNameValidatorTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @var DomainNameValidator
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new DomainNameValidator();

		$this->fixture->enableSilentMode();

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
	 * Assert that the validation result object has at least one error
	 *
	 * @param \TYPO3\Flow\Error\Result $result
	 * @param string $message
	 */
	protected function assertHasErrors(\TYPO3\Flow\Error\Result $result, $message = '') {
		self::assertThat(
			$result->hasErrors(),
			self::isTrue(),
			$message
		);
	}

	/**
	 * Assert that the validation result object has no errors
	 *
	 * @param \TYPO3\Flow\Error\Result $result
	 * @param string $message
	 */
	protected function assertNotHasErrors(\TYPO3\Flow\Error\Result $result, $message = '') {
		self::assertThat(
			$result->hasErrors(),
			self::isFalse(),
			$message
		);
	}

	/**
	 * @test
	 */
	public function isValidReturnsTrueOnValidDomainName() {
		$this->assertNotHasErrors(
			$this->fixture->validate('foobar.ch')
		);
	}

	/**
	 * @test
	 */
	public function isValidReturnsTrueOnValidDomainNameWithUmlauts() {
		$this->assertNotHasErrors(
			$this->fixture->validate('vögeli.ch')
		);
	}

	/**
	 * @test
	 */
	public function isValidRaisesErrorOnDomainNameWithoutADot() {
		$this->assertHasErrors(
			$this->fixture->validate('foobar')
		);
	}

	/**
	 * @test
	 */
	public function isValidRaisesErrorOnTooLongDomainName() {
		$this->assertHasErrors(
			$this->fixture->validate('foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobar' .
				'foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobar'.
				'foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobar' .
				'foobarfoobarfoobarfoobarfoobarfoobarfoobarfoobarfoobar.com')
		);
	}

	/**
	 * @test
	 * @dataProvider domainNamesWithInvalidCharactersProvider
	 */
	public function isValidRaisesErrorOnInvalidCharacters($domainName) {
		$this->assertHasErrors(
			$this->fixture->validate($domainName)
		);
	}

	/**
	 * Provides invalid domain names with invalid characters
	 *
	 * @return array
	 */
	public function domainNamesWithInvalidCharactersProvider() {
		return array(
			array('foo_bar.ch'),
			array('foo%bar.ch'),
			array('foo&bar.ch'),
			array('foo*bar.ch'),
			array('foo+bar.ch'),
			array('foo,bar.ch')
		);
	}

	/**
	 * @test
	 */
	public function isValidRaisesErrorOnDomainWithTooManyLabels() {
		$this->assertHasErrors(
			$this->fixture->validate('a.b.c.d.e.f.g.h.i.j.k.l.m.n.o.p.q.r.s.t.u.v.w.x.y.z.a.b.c.d.e.f.g.h.i.j.k.l.m.n.o.p.q.r.s.t.u.v.w.x.y.z.a.b.c.d.e.f.g.h.i.j.k.l.m.n.o.p.q.r.s.t.u.v.w.x.y.z.a.b.c.d.e.f.g.h.i.j.k.l.m.n.o.p.q.r.s.t.u.v.w.x.y.z.a.b.c.d.e.f.g.h.i.j.k.l.m.n.o.p.q.r.s.t.u.v.w.x') // 128 labels
		);
	}

	/**
	 * @test
 	 * @dataProvider invalidDomainNamesWithTooLongLabelsProvider
	 */
	public function isValidRaisesErrorOnDomainNameWithTooLongLabel($domainName) {
		$this->assertHasErrors(
			$this->fixture->validate($domainName)
		);
	}


	/**
	 * Provides invalid domain names that contain too long labels
	 *
	 * @return array
	 */
	public function invalidDomainNamesWithTooLongLabelsProvider() {
		return array(
			array('foo.aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'), // 64 characters
			array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.foo'), // 64 characters
			array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.foo.bar') // 64 characters
		);
	}

	/**
	 * @test
	 */
	public function isValidRaisesErrorOnDomainNameConsistingOfOnlyNumbers() {
		$this->assertHasErrors(
			$this->fixture->validate('12345.net')
		);
	}

	/**
	 * @test
	 * @dataProvider invalidDomainNamesWithDashesProvider
	 */
	public function isValidRaisesErrorOnDomainNameWithDashesOnTheBeginOrEndOfALabel($domainName) {
		$this->assertHasErrors(
			$this->fixture->validate($domainName)
		);
	}

	/**
	 * Provides invalid domain names dashes at the begin/end of labels
	 *
	 * @return array
	 */
	public function invalidDomainNamesWithDashesProvider() {
		return array(
			array('-foobar.ch'),
			array('foobar-.ch'),
			array('-.foobar.ch'),
			array('-foo.bar.ch'),
			array('foo-.bar.ch')
		);
	}
}