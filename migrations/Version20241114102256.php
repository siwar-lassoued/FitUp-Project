<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114102256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC89312FE9');
        $this->addSql('DROP INDEX IDX_3F596DCC89312FE9 ON coach');
        $this->addSql('ALTER TABLE coach DROP recette_id');
        $this->addSql('ALTER TABLE recette ADD coach_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63903C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('CREATE INDEX IDX_49BB63903C105691 ON recette (coach_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach ADD recette_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC89312FE9 ON coach (recette_id)');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63903C105691');
        $this->addSql('DROP INDEX IDX_49BB63903C105691 ON recette');
        $this->addSql('ALTER TABLE recette DROP coach_id');
    }
}
