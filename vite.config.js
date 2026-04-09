import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    // server: {
    //     hmr: {
    //         host: '5173-'+process.env.WEB_HOST, // ganti dengan domain kamu di idx
    //         protocol: 'wss', // atau 'ws' kalau tidak https
	//         clientPort: 443
    //     }
    // },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    base: '',
});
