<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322193151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initalize DB if not exists';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("CREATE SCHEMA IF NOT EXISTS `sr-calendar` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
