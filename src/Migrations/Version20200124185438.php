<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200124185438 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE employees_projects DROP FOREIGN KEY FK_22A27DD8482E9439');
        $this->addSql('ALTER TABLE employees_projects DROP FOREIGN KEY FK_22A27DD851CBC4B6');
        $this->addSql('DROP INDEX IDX_22A27DD851CBC4B6 ON employees_projects');
        $this->addSql('DROP INDEX IDX_22A27DD8482E9439 ON employees_projects');
        $this->addSql('ALTER TABLE employees_projects DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE employees_projects ADD project_id INT NOT NULL, ADD employee_id INT NOT NULL, DROP project_source, DROP project_target');
        $this->addSql('ALTER TABLE employees_projects ADD CONSTRAINT FK_22A27DD8166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employees_projects ADD CONSTRAINT FK_22A27DD88C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_22A27DD8166D1F9C ON employees_projects (project_id)');
        $this->addSql('CREATE INDEX IDX_22A27DD88C03F15C ON employees_projects (employee_id)');
        $this->addSql('ALTER TABLE employees_projects ADD PRIMARY KEY (project_id, employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE employees_projects DROP FOREIGN KEY FK_22A27DD8166D1F9C');
        $this->addSql('ALTER TABLE employees_projects DROP FOREIGN KEY FK_22A27DD88C03F15C');
        $this->addSql('DROP INDEX IDX_22A27DD8166D1F9C ON employees_projects');
        $this->addSql('DROP INDEX IDX_22A27DD88C03F15C ON employees_projects');
        $this->addSql('ALTER TABLE employees_projects DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE employees_projects ADD project_source INT NOT NULL, ADD project_target INT NOT NULL, DROP project_id, DROP employee_id');
        $this->addSql('ALTER TABLE employees_projects ADD CONSTRAINT FK_22A27DD8482E9439 FOREIGN KEY (project_source) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employees_projects ADD CONSTRAINT FK_22A27DD851CBC4B6 FOREIGN KEY (project_target) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_22A27DD851CBC4B6 ON employees_projects (project_target)');
        $this->addSql('CREATE INDEX IDX_22A27DD8482E9439 ON employees_projects (project_source)');
        $this->addSql('ALTER TABLE employees_projects ADD PRIMARY KEY (project_source, project_target)');
    }
}
