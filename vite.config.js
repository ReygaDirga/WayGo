import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/js/app.js', 
                    'resources/css/about.css',
                    'resources/js/about.js',
                    'resources/css/authentication/createprofile.css',
                    'resources/css/maps.css',
                    'resources/css/carousel.css',
                    'resources/js/location.js',
                    'resources/js/date.js',
                    'resources/js/travel.js',
                    'resources/js/maps.js',
                    'resources/js/carousel.js',
                    'resources/js/edit_profile.js',
                    'resources/js/blog_create.js',
                    'resources/css/category.css',
                    'resources/js/category.js',
                    'resources/css/card.css',
                    'resources/js/blog_hero.js',
                    'resources/js/blog_filterPosts.js',
                    'resources/js/imaps.js',
                    'resources/js/accordion.js',
                    'resources/js/modal.js',
                    'resources/js/blog_create_button.js',
                    'resources/css/authentication/preferences.css',
                    'resources/css/authentication/login.css',
                    'resources/css/authentication/done.css'
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
