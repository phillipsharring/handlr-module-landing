# Changelog

## 0.4.0

Adopt the handlr-frontend declarative behavior layer (ADR 0003).

### Changed

- The email-capture form now posts via HTMX (`hx-post` + `json-enc`) and resolves
  its response declaratively: `data-on-success="reveal:#email-capture-msg"` (hide
  form, show the success message) and `data-on-error="toast:…"`. The hand-rolled
  `document.addEventListener('submit', …)` + `fetch` handler in `src/index.js` is
  removed; `init()` is now a no-op kept for the module contract. The success text
  is pre-baked into `#email-capture-msg` in the landing page markup.

### Note

- landing requires a backend (`POST /api/email-capture`) and therefore a handlr
  **app** with the HTMX runtime + behavior layer — it is **not** usable on a pure
  static site. (This was already true via the backend requirement; the frontend
  now makes the app dependency explicit.)

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
- Compatible with `@phillipsharring/handlr-build` >= 0.3.0 module system
