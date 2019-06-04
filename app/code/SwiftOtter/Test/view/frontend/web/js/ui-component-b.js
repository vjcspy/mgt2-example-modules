define([
    'uiComponent'
], function(Component) {
    return Component.extend({
        defaults: {
            label: 'Component B',
            amount: 5,
            tracks: {
                amount: true
            },
            i: 0
        },
        initialize: function () {
            this._super();

            setInterval(function() {
                this.i++;
                this.amount = 5 * this.i;
            }.bind(this), 1000);

            return this;
        }
    })
});