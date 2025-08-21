import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        colors: {
          primary: {
            DEFAULT: '#22c55e',    // green-500: vibrant & clean
            light: '#c6fad6ff',      // green-100: soft background
            dark: '#155e2fff',       // green-700: trust & reliability
          },
          secondary: {
            DEFAULT: '#bbf7d0',    // soft mint (green-200)
            light: '#e9e9e9b6',      // very light mint
            dark: '#1c6436ff',       // green-400: nice contrast
          },
          accent: {
            DEFAULT: '#facc15',    // yellow-400: soft attention
            light: '#fef9c3',      // yellow-100: subtle highlight
            dark: '#b1900fff',       // yellow-700: warm warning
          },
          button: {
            primary: '#ff9100ff',    // green main
            hover: '#ff9d1dff',      // deeper green
            disabled: '#fabf71ff',   // soft, inactive mint
          },
          text: {
            base: '#1f2937',        // gray-800: clear readability
            muted: '#6b7280',       // gray-500: for secondary text
            light: '#ffffff',       // white text on buttons
          },
        }

            
        },  
    },

    plugins: [forms],
};
