export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/css/*.css',
        './resources/js/**/*.{vue,js,ts,jsx,tsx}'
    ],
    theme: {
        extend: {
            colors: {
                midnight: '#1F1D2B',
                gold: '#C6A46A',
                sand: '#F7F1E8',
                smoke: '#E7E2D8'
            },
            fontFamily: {
                display: ['"Playfair Display"', 'serif'],
                body: ['"Inter"', 'sans-serif']
            },
            boxShadow: {
                soft: '0 20px 50px rgba(15, 14, 16, 0.15)'
            }
        }
    },
    plugins: []
}
