<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220209105815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE weather_condition (id INT AUTO_INCREMENT NOT NULL, weather_station_id INT NOT NULL, date_time DATETIME NOT NULL, temperature NUMERIC(6, 2) NOT NULL, humidity NUMERIC(5, 2) NOT NULL, rain NUMERIC(6, 2) NOT NULL, wind_speed NUMERIC(6, 2) NOT NULL, battery_level INT NOT NULL, INDEX IDX_975809709E475DA2 (weather_station_id), INDEX datetime_idx (date_time), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weather_station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE weather_condition ADD CONSTRAINT FK_975809709E475DA2 FOREIGN KEY (weather_station_id) REFERENCES weather_station (id)');

        // some test data
        $this->addSql('INSERT INTO weather_station (id, name) 
                            VALUES (1, "Station One"), (2, "Station Two")'
        );
        $this->addSql('INSERT INTO weather_condition (id, weather_station_id, date_time, temperature, humidity, rain, wind_speed, battery_level) 
                            VALUES (1, 1, "2022-01-01 12:08:04", 5.25, 6.26, 0.00, 12.00, 21),
                                   (2, 1, "2022-01-02 13:08:32", 2.32, 23.32, 3.00, 32.22, 16);
                                   (3, 2, "2022-01-01 18:09:24", 32.20, 34.20, 23.20, 84.00, 12)
                                   (4, 2, "2022-01-02 19:09:53", 25.90, 3.00, 23.00, 23.00, 83);'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE weather_condition DROP FOREIGN KEY FK_975809709E475DA2');
        $this->addSql('DROP TABLE weather_condition');
        $this->addSql('DROP TABLE weather_station');
    }
}
