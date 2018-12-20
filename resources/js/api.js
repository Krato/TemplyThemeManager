export default {
    getThemes() {
        return window.axios.get('/nova-vendor/temply-theme-manager/themes').then(response => response.data);
    },
    setTheme(theme, pallete) {
        return window.axios
            .post('/nova-vendor/temply-theme-manager/set-theme', {
                theme: theme,
                pallete: pallete,
            })
            .then(response => response.data);
    },
};
