import { fileURLToPath } from 'node:url';
import path from 'node:path';

const moduleRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');

export const landing = {
    name: 'landing',
    pagesDir: path.join(moduleRoot, 'pages'),
    componentsDir: path.join(moduleRoot, 'components'),

    defaults: {
        adminNav: {
            label: 'Email Captures',
            path: '/admin/email-captures/',
            permission: 'admin.access',
        },
    },

    config: {},

    init() {
        // Runtime JS for the landing page (email capture form handlers, etc.)
    },
};
