define([
    'uiComponent'
], function(Component) {
    return Component.extend({
        defaults: {
            price: 11,
            tracks: {
                price: true
            },
            imports: {
                price: '${$.provider}:price'
            }
        }
    })
});