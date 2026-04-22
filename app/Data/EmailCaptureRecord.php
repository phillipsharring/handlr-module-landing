<?php

declare(strict_types=1);

namespace Handlr\Module\Landing\Data;

use Handlr\Database\Record;

/**
 * @property string $email
 * @property string|null $source
 * @property string $created_at
 */
class EmailCaptureRecord extends Record
{
    protected array $casts = [
        'created_at' => 'datetime',
    ];
}
