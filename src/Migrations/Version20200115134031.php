<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115134031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car_submodels ADD car_model_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car_submodels ADD CONSTRAINT FK_85484A00F64382E3 FOREIGN KEY (car_model_id) REFERENCES car_models (id)');
        $this->addSql('CREATE INDEX IDX_85484A00F64382E3 ON car_submodels (car_model_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car_submodels DROP FOREIGN KEY FK_85484A00F64382E3');
        $this->addSql('DROP INDEX IDX_85484A00F64382E3 ON car_submodels');
        $this->addSql('ALTER TABLE car_submodels DROP car_model_id');
    }
}
