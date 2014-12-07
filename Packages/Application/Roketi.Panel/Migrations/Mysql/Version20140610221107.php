<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140610221107 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('CREATE TABLE roketi_panel_domain_model_domain (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, idnaname VARCHAR(255) NOT NULL, enabledns TINYINT(1) NOT NULL, enablemailservice TINYINT(1) NOT NULL, createtime DATETIME NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql');

		$this->addSql('DROP TABLE roketi_panel_domain_model_domain');
	}
}