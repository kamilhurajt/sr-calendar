<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322193910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create category event mapping table';
    }

    public function up(Schema $schema) : void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `event_category` (
                  `id` BIGINT NOT NULL AUTO_INCREMENT,
                  `event_id` INT NOT NULL,
                  `category_id` INT NOT NULL,
                  PRIMARY KEY (`id`, `event_id`, `category_id`),
                  INDEX `event_to_category_key` (`event_id` ASC),
                  INDEX `category_to_event_key` (`category_id` ASC),
                  CONSTRAINT `event_to_category_foreignkey`
                    FOREIGN KEY (`event_id`)
                    REFERENCES `sr-calendar`.`event` (`id`)
                    ON DELETE CASCADE
                    ON UPDATE NO ACTION,
                  CONSTRAINT `category_to_event_foreignkey`
                    FOREIGN KEY (`category_id`)
                    REFERENCES `sr-calendar`.`category` (`id`)
                    ON DELETE CASCADE
                    ON UPDATE NO ACTION)
                ENGINE = InnoDB';

        $this->addSql($sql);

    }

    public function down(Schema $schema) : void
    {
        $sql = 'DROP TABLE IF EXISTS `event_category`';

        $this->addSql($sql);
    }
}
