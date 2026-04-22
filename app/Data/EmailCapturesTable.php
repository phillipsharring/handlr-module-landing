<?php

declare(strict_types=1);

namespace Handlr\Module\Landing\Data;

use Handlr\Database\Table;

class EmailCapturesTable extends Table
{
    protected string $tableName = 'email_captures';
    protected string $recordClass = EmailCaptureRecord::class;
}
