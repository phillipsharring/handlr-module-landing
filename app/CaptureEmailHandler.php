<?php

declare(strict_types=1);

namespace Handlr\Module\Landing;

use Handlr\Module\Landing\Data\EmailCapturesTable;
use Handlr\Module\Landing\Data\EmailCaptureRecord;
use Handlr\Handlers\Handler;
use Handlr\Handlers\HandlerInput;
use Handlr\Handlers\HandlerResult;

class CaptureEmailHandler implements Handler
{
    public function __construct(
        private readonly EmailCapturesTable $captures,
        private readonly HandlerResult $result,
    ) {}

    public function handle(array|HandlerInput $input): ?HandlerResult
    {
        $existing = $this->captures->findFirst([], ['email' => $input->email]);
        if ($existing) {
            return $this->result->ok();
        }

        $record = new EmailCaptureRecord([
            'email' => $input->email,
            'source' => $input->source,
        ]);
        $this->captures->insert($record);

        return $this->result->ok();
    }
}
