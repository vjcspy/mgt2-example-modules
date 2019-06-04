define(['jquery'], function(jQuery) {
    return function(original) {
        jQuery.widget(
            'mage.tabs',
            jQuery['mage']['tabs'],
            {
                activate: function() {
                    return this._super();
                }
            }
        );

        return jQuery['mage']['tabs'];
    }
});