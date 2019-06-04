define([
  'jquery',
  'jquery/ui',
  'mage/tabs'
], function($) {
    $.widget('swiftotter.customTabs', $.mage.tabs, {
        doSomething: function(input) {
            // alert("Nothing like a good ol' fashioned ALERT in your face. Input value: " + input);
        }
    });
});
