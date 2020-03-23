<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322193300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create event table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `event` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR(255) NOT NULL,
                  `description` LONGTEXT NULL,
                  `user_password` VARCHAR(255) NOT NULL,
                  `start_date` DATETIME NOT NULL,
                  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  INDEX `user_password_key` (`user_password` ASC) ,
                  INDEX `start_date_key` (`start_date` DESC))
                ENGINE = InnoDB';

        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = 'DROP TABLE IF EXISTS `event`';

        $this->addSql($sql);
    }
}
