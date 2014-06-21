<?php

use Behat\Behat\Context\Step;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as Assert;

require_once(__DIR__ . '/../../../../../Flowpack.Behat/Tests/Behat/FlowContext.php');

/**
 * Features context
 */
class FeatureContext extends MinkContext {
	/**
	 * @var \TYPO3\Flow\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * Initializes the context
	 *
	 * @param array $parameters Context parameters (configured through behat.yml)
	 */
	public function __construct(array $parameters) {
		$this->useContext('flow', new \Flowpack\Behat\Tests\Behat\FlowContext($parameters));
		$this->objectManager = $this->getSubcontext('flow')->getObjectManager();
	}

	/**
	 * @Given /^I am not logged in$/
	 */
	public function iAmNotLoggedIn() {
		// Do nothing, every scenario has a new session
	}

	/**
	 * @Given /^I am logged in as "([^"]*)" with password "([^"]*)"$/
	 */
	public function iAmLoggedInAsWithPassword($username, $password) {
		$this->visit('/');
		$this->fillField('username', $username);
		$this->fillField('password', $password);
		$this->pressButton('login');
	}

	/**
	 * @Then /^I should see a login form$/
	 */
	public function iShouldSeeALoginForm() {
		$this->assertSession()->fieldExists('username');
		$this->assertSession()->fieldExists('password');
	}
	/**
	 * @Given /^I should be logged in as "([^"]*)"$/
	 */
	public function iShouldBeLoggedInAs($name) {
		$this->assertSession()->pageTextContains('Signed in as ' . $name);
	}

	/**
	 * @Then /^I should not be logged in$/
	 */
	public function iShouldNotBeLoggedIn() {
		if ($this->getSession()->getPage()->findButton('logout')) {
			Assert::fail('"Logout" Button not expected');
		}
	}

	/**
	 * @Given /^there is a domain "([^"]*)"$/
	 */
	public function thereIsADomain($domainName) {
		return array(
			new Step\When('I go to "/domain/new"'),
			new Step\When('I fill in "' . $domainName . '" for "newDomainName"'),
			new Step\Then('I press "Create Domain"'),
		);
	}

}
