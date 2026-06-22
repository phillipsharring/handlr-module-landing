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

    init() {
        document.addEventListener('submit', function(e) {
            var form = e.target.closest('#email-capture-form');
            if (!form) return;

            e.preventDefault();

            var email = form.querySelector('input[name="email"]').value;
            var btn = form.querySelector('button[type="submit"]');
            var msg = document.getElementById('email-capture-msg');

            btn.disabled = true;
            btn.textContent = 'Sending...';

            fetch('/api/email-capture', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email: email, source: 'landing' }),
            })
            .then(function(r) { return r.json(); })
            .then(function() {
                form.classList.add('hidden');
                if (msg) {
                    msg.textContent = "You're on the list!";
                    msg.className = 'mt-4 text-sm text-green-600 font-medium';
                }
            })
            .catch(function() {
                btn.disabled = false;
                btn.textContent = 'Notify Me';
                if (msg) {
                    msg.textContent = 'Something went wrong. Please try again.';
                    msg.className = 'mt-4 text-sm text-red-600';
                }
            });
        });
    },
};
