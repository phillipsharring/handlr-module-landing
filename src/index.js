/**
 * Landing module for handlr/handlr apps.
 *
 * Build-time: provides pagesDir/componentsDir for handlr-build to discover pages.
 * Runtime: provides init() for email capture form handling.
 */

const root = new URL('..', import.meta.url).pathname;

export const landing = {
    name: 'landing',
    pagesDir: root + 'pages',
    componentsDir: root + 'components',

    defaults: {
        adminNav: {
            label: 'Email Captures',
            path: '/admin/email-captures/',
            permission: 'admin.access',
        },
    },

    config: {},

    // The email-capture form now posts via HTMX and resolves its response
    // declaratively (hx-post + json-enc + data-on-success/-error, ADR 0003):
    // on success the form hides and #email-capture-msg is revealed; on error a
    // toast shows. The host app's ./init drives this — no runtime wiring needed.
    // Kept for the module contract; safe to call, does nothing.
    //
    // NOTE: landing requires a backend (POST /api/email-capture) and therefore a
    // handlr app with HTMX — it is not usable on a pure static site.
    init() {},
};
