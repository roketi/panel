<?php
namespace Roketi\Panel\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Roketi.Panel".          *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class LogEntryRepository extends Repository {

	/**
	 * Returns the latest log entries, 100 by default
	 *
	 * @param int $limit
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findLatest($limit = 100) {
		$query = $this->createQuery();
		$query->setOrderings(
			array(
				'timeStamp' => $query::ORDER_DESCENDING
			)
		);
		$query->setLimit($limit);

		return $query->execute();
	}
}