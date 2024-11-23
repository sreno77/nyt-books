import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config } */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{vue,js}',
        './vendor/livewire/flux-pro/stubs/**/*.blade.php',
        './vendor/livewire/flux/stubs/**/*.blade.php',
    ],

    darkMode: ['selector'],

    theme: {
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        /*fontSize: {
            xs: '12px',
            sm: '14px',
            base: '16px',
            lg: '18px',
            xl: '20px',
            '2xl': '24px',
            '3xl': '30px',
            '4xl': '36px',
            '5xl': '48px',
            '6xl': '60px',
            '7xl': '72px',
        },*/
        extend: {
            /*spacing: {
                '1': '4px',
                '2': '8px',
                '3': '12px',
                '4': '16px',
                '5': '24px',
                '6': '32px',
                '7': '48px',
                '8': '64px',
                '9': '96px',
                '10': '128px',
                '11': '192px',
                '12': '256px',
                '13': '384px',
                '14': '512px',
                '15': '640px',
                '16': '768px',
            },*/
            colors: {
                // primary
                'blue': {
                    '900': '#12283a',
                    '800': '#194a71',
                    '700': '#2369a2',
                    '600': '#3084c8',
                    '500': '#63a4d8',
                    '400': '#aad5f5',
                    '300': '#eff9ff',
                },
                // secondary
                'green': {
                    '900': '#114543',
                    '800': '#1b655d',
                    '700': '#2a9187',
                    '600': '#3caea3',
                    '500': '#6ed7d2',
                    '400': '#a8eeeb',
                    '300': '#e7fffe'
                },
                // neutral
                'gray': {
                    '900': '#212934',
                    '800': '#5f6b7a',
                    '700': '#8896a7',
                    '600': '#b8c4ce',
                    '500': '#d0d6de',
                    '400': '#e2e8ec',
                    '300': '#f9f9fa'
                },
                // accent color red
                'red': {
                    '900': '#601818',
                    '800': '#881a1a',
                    '700': '#b71f1f',
                    '600': '#db3030',
                    '500': '#e36464',
                    '400': '#f4aaaa',
                    '300': '#fbe8e8'
                },
                // accent color yellow
                'yellow': {
                    '900': '#5c4712',
                    '800': '#8c6b1e',
                    '700': '#caa53d',
                    '600': '#f4c963',
                    '500': '#fae29f',
                    '400': '#fdf3d8',
                    '300': '#fffcf4'
                },
                // accent color emerald
                'emerald': {
                    '900': '#145238',
                    '800': '#187740',
                    '700': '#259d57',
                    '600': '#38c171',
                    '500': '#74d99e',
                    '400': '#a8eec1',
                    '300': '#e4fcec'
                },

                'aiGray-100': '#EEEEEE',
                'aiGray-400': '#DEDFDF',
                'aiGray-800': '#75787B',
                'aiGray-900': '#5F6369',
                'aiDarkBg': '#2A3441',
            },
        },
    },

    plugins: [forms, typography],
}