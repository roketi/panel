<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migration to add the domain name uniqueness constraint
 */
class Version20140621203553 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('CREATE UNIQUE INDEX flow_identity_roketi_panel_domain_model_domain ON roketi_panel_domain_model_domain (punycodename)');
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('DROP INDEX flow_identity_roketi_panel_domain_model_domain ON roketi_panel_domain_model_domain');
	}
}