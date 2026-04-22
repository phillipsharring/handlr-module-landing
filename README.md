# handlr-module-landing

![Graspr](graspr.png)

Landing page module for [handlr](https://github.com/phillipsharring/handlr-framework)/[graspr](https://github.com/phillipsharring/graspr-framework) apps. Provides a "coming soon" email capture page and admin list.

## Install

```bash
composer require phillipsharring/handlr-module-landing
```

One package. Composer installs both the PHP backend (service provider, handlers, migration) and the frontend assets (pages, components, JS module definition).

## Setup

Two lines to connect:

**1. Register the service provider** in `backend/app/config.php`:

```php
'providers' => [
    // ...
    Handlr\Module\Landing\LandingServiceProvider::class,
],
```

**2. Register the frontend module** in `frontend/site.config.js`:

```js
import { landing } from '../backend/vendor/phillipsharring/handlr-module-landing/src/index.js';

export default {
    // ...
    modules: [landing],
};
```

**3. Run the migration** to create the `email_captures` table:

```bash
composer run migrate
```

## What's included

### Backend

- `POST /api/public/email-capture` -- captures an email address (public, no auth required)
- `GET /api/admin/email-captures` -- lists all captured emails (admin only)
- `email_captures` table migration (auto-discovered via `migrationPaths()`)

### Frontend

- `/landing/` page with email capture form
- Module object with self-resolving `pagesDir` and `componentsDir` for graspr-build

## Configuration

Override defaults with `configure()` from `@phillipsharring/graspr-build`:

```js
import { configure } from '@phillipsharring/graspr-build/modules';
import { landing } from '../backend/vendor/phillipsharring/handlr-module-landing/src/index.js';

export default {
    modules: [
        configure(landing, { adminNav: false }),
    ],
};
```

## Removal

1. Remove `LandingServiceProvider::class` from `config.php`
2. Remove the `landing` import and entry from `site.config.js`
3. `composer remove phillipsharring/handlr-module-landing`
4. Roll back the migration (or drop the `email_captures` table)

## Requires

- `phillipsharring/handlr-framework` >= 0.5
- `@phillipsharring/graspr-build` >= 0.3.0 (for module support in the build system)
