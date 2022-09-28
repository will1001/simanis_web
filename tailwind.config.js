/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                buttonColor: {
                    100: "#F7E6E6",
                    200: "#EBBFC0",
                    300: "#DF9999",
                    400: "#C64D4D",
                    500: "#AE0001",
                    600: "#9D0001",
                    700: "#680001",
                    800: "#4E0000",
                    900: "#3AA0F8",
                },
                tableColor: {
                    100: "#F7E6E6",
                    200: "#EBBFC0",
                    300: "#DF9999",
                    400: "#C64D4D",
                    500: "#AE0001",
                    600: "#9D0001",
                    700: "#680001",
                    800: "#4E0000",
                    900: "#374151",
                },
                ditolakTextColor: "#DC2626",
                ditolakBgColor: "#FEE2E2",
                menungguTextColor: "#D97706",
                menungguBgColor: "#FEF3C7",
                disetujuiTextColor: "#1D8AE8",
                disetujuiBgColor: "#D7ECFF",
                halalTextColor: "#A332AD",
                halalBgColor: "#FFD8F9",
                textColor1: "#D1D5DB",
                textColor2: "#374151",
                buttonDelete: "#B91C1C",
            },
        },
    },
    plugins: [],
};
