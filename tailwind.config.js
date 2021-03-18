const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors");
module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php'
    ],
    theme: {
        fontSize: {
            "4xl": "2rem",
            "line-height": "3rem"
        },
        borderRadius: {
            xl: "10px"
        },
        boxShadow: {
            DEFAULT: "1px 1px 5px 0 rgba(0, 0, 0, 0.16)"
        },
        colors: {
            green: {
                ...colors.green,
                DEFAULT: "#28a745"
            },
            red: {
                ...colors.red,
                DEFAULT: "#dc3545"
            },
            yellow: {
                ...colors.yellow,
                DEFAULT: "#ffc107"
            },
            blue: {
                ...colors.blue,
                DEFAULT: "#17a2b8"
            },
            social: {
                facebook: "#3b5998",
                twitter: "#1da1f2",
                pinterest: "#bd081c",
                whatsapp: "#25d366"
            }
        },
        spacing: {
            "1/1": "100%",
            "3/4": "75%",
            "9/16": "56.25%"
        },
        container: {
            center: true,
            padding: "1rem"
        },
        fontFamily: {
            body: [
                "Nunito Sans", "sans-serif"
            ],
            heading: ["Nunito", "sans-serif"]
        }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            cursor: ['disabled'],
        }
    },

    plugins: [require('@tailwindcss/forms')]
};
