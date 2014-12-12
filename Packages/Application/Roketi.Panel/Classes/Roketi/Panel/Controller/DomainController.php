<?php
namespace Roketi\Panel\Controller;

/*                                                                     *
 * This script belongs to the TYPO3 Flow package 'Roketi.Panel'.       *
 *                                                                     *
 *                                                                     */

use TYPO3\Flow\Annotations as Flow;

/**
 * Domain controller
 */
class DomainController extends BaseController {

	/**
	 * @var \Roketi\Panel\Domain\Repository\DomainRepository
	 * @Flow\Inject
	 */
	protected $domainRepository;

	/**
	 * Render the list of stored domains
	 */
	public function indexAction() {
		$this->view->assign(
			'domains',
			$this->domainRepository->findAll()
		);
	}

	/**
	 * Renders a form to create a new domain
	 */
	public function newAction() {
	}

	/**
	 * Stores a new domain in the repository
	 *
	 * @param \Roketi\Panel\Domain\Model\Domain $newDomain
	 * @Flow\Validate(argumentName="newDomain", type="UniqueEntity")
	 */
	public function createAction(\Roketi\Panel\Domain\Model\Domain $newDomain) {
		$this->domainRepository->add($newDomain);

		$this->addFlashMessage(
			$this->translate('message.created_successfully', 'Domain')
		);
		$this->redirect('index');
	}

	/**
	 * Deletes a domain from the system
	 *
	 * @param \Roketi\Panel\Domain\Model\Domain $domain
	 * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
	 */
	public function deleteAction(\Roketi\Panel\Domain\Model\Domain $domain) {
		$this->domainRepository->remove($domain);

		$this->addFlashMessage(
			$this->translate('message.deleted_successfully', 'Domain')
		);

		$this->redirect('index');
	}
}