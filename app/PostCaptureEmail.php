<?php

declare(strict_types=1);

namespace Handlr\Module\Landing;

use Handlr\Api\Presenter;
use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Handlers\ValidatedInputFactory;
use Handlr\Pipes\Pipe;

class PostCaptureEmail implements Pipe
{
    public function __construct(
        private readonly CaptureEmailHandler $handler,
        private readonly ValidatedInputFactory $factory,
        private readonly Presenter $presenter,
    ) {}

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        /**
         * @var CaptureEmailInput $input
         * @see CaptureEmailInput::validate()
         */
        [$input, $errors] = $this->factory->makeValidatedInput(
            $request,
            CaptureEmailInput::class,
            'validate'
        );

        if ($errors) {
            return $response->withStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->withJson($this->presenter->validationError('Please enter a valid email.', $errors));
        }

        $this->handler->handle($input);

        return $response->withStatus(Response::HTTP_OK)
            ->withJson($this->presenter->success("You're on the list!"));
    }
}
