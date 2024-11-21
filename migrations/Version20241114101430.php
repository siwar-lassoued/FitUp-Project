<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114101430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach ADD r_dv_id INT NOT NULL, ADD recette_id INT NOT NULL');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCCA0A596B1 FOREIGN KEY (r_dv_id) REFERENCES rdv (id)');
        $this->addSql('ALTER TABLE coach ADD CONSTRAINT FK_3F596DCC89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_3F596DCCA0A596B1 ON coach (r_dv_id)');
        $this->addSql('CREATE INDEX IDX_3F596DCC89312FE9 ON coach (recette_id)');
        $this->addSql('ALTER TABLE user ADD r_dv_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A0A596B1 FOREIGN KEY (r_dv_id) REFERENCES rdv (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A0A596B1 ON user (r_dv_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCCA0A596B1');
        $this->addSql('ALTER TABLE coach DROP FOREIGN KEY FK_3F596DCC89312FE9');
        $this->addSql('DROP INDEX IDX_3F596DCCA0A596B1 ON coach');
        $this->addSql('DROP INDEX IDX_3F596DCC89312FE9 ON coach');
        $this->addSql('ALTER TABLE coach DROP r_dv_id, DROP recette_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A0A596B1');
        $this->addSql('DROP INDEX IDX_8D93D649A0A596B1 ON user');
        $this->addSql('ALTER TABLE user DROP r_dv_id');
    }
}
