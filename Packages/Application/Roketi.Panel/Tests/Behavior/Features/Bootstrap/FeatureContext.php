<?php

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\TableNode,
	Behat\MinkExtension\Context\MinkContext;
use TYPO3\Flow\Utility\Arrays;
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
}
