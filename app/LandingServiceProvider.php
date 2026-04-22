<?php

declare(strict_types=1);

namespace Handlr\Module\Landing;

use Handlr\Core\Routes\Router;
use Handlr\Core\ServiceProvider;

class LandingServiceProvider extends ServiceProvider
{
    public function routes(Router $router): void
    {
        $router->intoJunction('api.public')
            ->post('/email-capture', [PostCaptureEmail::class]);

        $router->intoJunction('api.admin')
            ->get('/email-captures', [GetEmailCaptures::class]);
    }

    public function migrationPaths(): array
    {
        return [dirname(__DIR__) . '/migrations'];
    }
}
