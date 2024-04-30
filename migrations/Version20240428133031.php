<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240428133031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, token VARCHAR(255) NOT NULL, nombre_apellido VARCHAR(255) NOT NULL, id_usuario VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_ID_USUARIO (id_usuario), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE citas RENAME INDEX idx_b88cf8e57bf9ce86 TO IDX_B88CF8E5E4A5F0D7');
        $this->addSql('ALTER TABLE citas RENAME INDEX idx_b88cf8e569d86e10 TO IDX_B88CF8E59825D871');
        $this->addSql('ALTER TABLE gastos CHANGE precio precio NUMERIC(38, 0) DEFAULT NULL');
        $this->addSql('ALTER TABLE gastos RENAME INDEX idx_17a58ace8f12801 TO IDX_17A58ACEA2A4398');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('ALTER TABLE citas RENAME INDEX idx_b88cf8e5e4a5f0d7 TO IDX_B88CF8E57BF9CE86');
        $this->addSql('ALTER TABLE citas RENAME INDEX idx_b88cf8e59825d871 TO IDX_B88CF8E569D86E10');
        $this->addSql('ALTER TABLE gastos CHANGE precio precio NUMERIC(38, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE gastos RENAME INDEX idx_17a58acea2a4398 TO IDX_17A58ACE8F12801');
    }
}
