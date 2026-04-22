# @phillipsharring/handlr-module-landing

![Graspr](graspr.png)

Landing page module for [Graspr](https://github.com/phillipsharring/graspr-framework) sites. Provides a "coming soon" email capture page that works in both static sites and full handlr apps.

## Install

```bash
npm install @phillipsharring/handlr-module-landing
```

## Usage

Register the module in your `site.config.js`:

```js
import { landing } from '@phillipsharring/handlr-module-landing';

export default {
    siteName: 'My App',
    modules: [landing],
};
```

This adds a `/landing/` page to your site with an email capture form.

## Configuration

Override defaults with `configure()` from `@phillipsharring/graspr-build`:

```js
import { configure } from '@phillipsharring/graspr-build/modules';
import { landing } from '@phillipsharring/handlr-module-landing';

export default {
    modules: [
        configure(landing, {
            adminNav: false,  // disable admin nav item
        }),
    ],
};
```

## What's included

- **Pages:** `/landing/` -- email capture form
- **Components:** (none yet)
- **Admin:** email captures list (requires backend service provider)

## Requires

- `@phillipsharring/graspr-build` >= 0.3.0 for module support
