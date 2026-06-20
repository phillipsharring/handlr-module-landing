# Changelog

## 0.2.1

Browser-safe module + email capture frontend.

### Fixed

- The module is now browser-safe. `src/index.js` previously imported `node:url`/`node:path` to compute `pagesDir`/`componentsDir`, which dragged Node-only code into consuming apps' browser bundles and broke their production builds (`"fileURLToPath" is not exported by "__vite-browser-external"`). It now derives its root from `new URL('..', import.meta.url).pathname` and builds the paths by string concatenation — no `node:` imports.

### Added

- `init()` now implements the email-capture form handler (POSTs to `/api/email-capture`, success/error states), replacing the previous stub.
- `components/email-capture.html` form component and an `/admin/email-captures/` admin page.

## 0.1.0

Initial release.

### Added

- Module object export with self-resolving `pagesDir` and `componentsDir`
- `/landing/` page with email capture form
- Default `adminNav` config for admin integration
- Compatible with `@phillipsharring/graspr-build` >= 0.3.0 module system
