<?php

declare(strict_types=1);

namespace Handlr\Module\Landing;

use Handlr\Handlers\HandlerInput;
use Handlr\Validation\ValidatesRules;
use Handlr\Validation\Validator;

class CaptureEmailInput implements HandlerInput
{
    use ValidatesRules;

    public string $email;
    public string $source;

    public function __construct(private array $body = [], private ?Validator $validator = null)
    {
        $this->email = strtolower(trim($this->body['email'] ?? ''));
        $this->source = trim($this->body['source'] ?? 'landing');
    }

    protected function getValidator(): Validator
    {
        return $this->validator;
    }

    protected function getBody(): array
    {
        return $this->body;
    }

    public function validate(): array
    {
        return $this->runValidation([
            'email' => ['required', 'email'],
        ]);
    }
}
