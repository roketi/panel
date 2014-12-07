<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Migration to change the idnaname column to punycodename
 */
class Version20140621191304 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('ALTER TABLE roketi_panel_domain_model_domain CHANGE idnaname punycodename VARCHAR(255) NOT NULL');
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('ALTER TABLE roketi_panel_domain_model_domain CHANGE punycodename idnaname VARCHAR(255) NOT NULL');
	}
}