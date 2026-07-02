// Copies the self-hosted TinyMCE distribution from node_modules into public/tinymce
// so it can be served locally without a CDN or API key.
import { cpSync, existsSync, rmSync } from 'node:fs';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const here = dirname(fileURLToPath(import.meta.url));
const src = resolve(here, '../node_modules/tinymce');
const dest = resolve(here, '../public/tinymce');

if (!existsSync(src)) {
    console.warn('[copy-tinymce] node_modules/tinymce not found; skipping.');
    process.exit(0);
}

try {
    rmSync(dest, { recursive: true, force: true });
    cpSync(src, dest, { recursive: true });
    console.log('[copy-tinymce] Copied TinyMCE -> public/tinymce');
} catch (err) {
    console.error('[copy-tinymce] Failed:', err.message);
    process.exit(0);
}
