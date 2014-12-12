<?php
namespace Roketi\Panel\Aspects;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Rokei.Panel".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 * @Flow\Aspect
 */
class DomainAspect {
	/**
	 * @var \Roketi\Panel\Service\LoggingService
	 * @Flow\Inject
	 */
	protected $loggingService;

	/**
	 * Logs creation of a new domain
	 *
	 * @Flow\After("method(Roketi\Panel\Controller\DomainController->createAction())")
	 * @return mixed
	 */
	public function logDomainCreation() {
		$this->loggingService->log(
			'domain',
			'domain_created'
		);
	}

	/**
	 * Logs deletion of a new domain
	 *
	 * @Flow\After("method(Roketi\Panel\Controller\DomainController->deleteAction())")
	 * @return mixed
	 */
	public function logDomainDeletion() {
		$this->loggingService->log(
			'domain',
			'domain_deleted'
		);
	}
}