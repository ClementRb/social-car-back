<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115133813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car_models (id INT AUTO_INCREMENT NOT NULL, car_brand_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FCBEDCFBCBC3E50C (car_brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_models ADD CONSTRAINT FK_FCBEDCFBCBC3E50C FOREIGN KEY (car_brand_id) REFERENCES cars_brand (id)');
        $this->addSql('ALTER TABLE car_submodels DROP FOREIGN KEY FK_85484A007975B7E7');
        $this->addSql('DROP INDEX IDX_85484A007975B7E7 ON car_submodels');
        $this->addSql('ALTER TABLE car_submodels DROP model_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE car_models');
        $this->addSql('ALTER TABLE car_submodels ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE car_submodels ADD CONSTRAINT FK_85484A007975B7E7 FOREIGN KEY (model_id) REFERENCES car_model (id)');
        $this->addSql('CREATE INDEX IDX_85484A007975B7E7 ON car_submodels (model_id)');
    }
}
