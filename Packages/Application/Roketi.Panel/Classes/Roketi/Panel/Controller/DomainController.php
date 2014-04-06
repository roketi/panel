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
	 */
	public function createAction(\Roketi\Panel\Domain\Model\Domain $newDomain) {
		$this->domainRepository->add($newDomain);

		$this->addFlashMessage(
			$this->translate('message.created_successfully', 'Domain')
		);
		$this->redirect('index');
	}
}