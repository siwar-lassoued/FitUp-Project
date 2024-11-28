<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128134439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_10C31F86A76ED395 ON rdv (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A0A596B1');
        $this->addSql('DROP INDEX IDX_8D93D649A0A596B1 ON user');
        $this->addSql('ALTER TABLE user DROP r_dv_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86A76ED395');
        $this->addSql('DROP INDEX IDX_10C31F86A76ED395 ON rdv');
        $this->addSql('ALTER TABLE rdv DROP user_id');
        $this->addSql('ALTER TABLE user ADD r_dv_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A0A596B1 FOREIGN KEY (r_dv_id) REFERENCES rdv (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A0A596B1 ON user (r_dv_id)');
    }
}
