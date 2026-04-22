<?php

declare(strict_types=1);

use Handlr\Database\Migrations\BaseMigration;

class Migration_20260422000000_CreateEmailCapturesTable extends BaseMigration
{
    public function up(): void
    {
        $sql = <<<'SQL'
            CREATE TABLE IF NOT EXISTS `email_captures` (
                `id` BINARY(16) NOT NULL PRIMARY KEY,
                `email` VARCHAR(255) NOT NULL,
                `source` VARCHAR(50) DEFAULT 'landing',
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                UNIQUE INDEX `idx_email` (`email`)
            ) ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_0900_ai_ci;
        SQL;
        $this->db->execute($sql);
    }

    public function down(): void
    {
        $this->db->execute("DROP TABLE IF EXISTS `email_captures`;");
    }
}
