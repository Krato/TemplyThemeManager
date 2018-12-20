Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'temply-theme-manager',
            path: '/temply-theme-manager',
            component: require('./components/Tool'),
        },
    ]);
});
