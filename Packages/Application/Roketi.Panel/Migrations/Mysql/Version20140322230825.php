<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Add table for the log entries
 */
class Version20140322230825 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('CREATE TABLE roketi_panel_domain_model_logentry (persistence_object_identifier VARCHAR(40) NOT NULL, account VARCHAR(40) DEFAULT NULL, timestamp DATETIME NOT NULL, remoteip VARCHAR(255) NOT NULL, component VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, INDEX IDX_64EC02747D3656A4 (account), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
		$this->addSql('ALTER TABLE roketi_panel_domain_model_logentry ADD CONSTRAINT FK_64EC02747D3656A4 FOREIGN KEY (account) REFERENCES typo3_flow_security_account (persistence_object_identifier)');
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');
		$this->addSql('DROP TABLE roketi_panel_domain_model_logentry');
	}
}