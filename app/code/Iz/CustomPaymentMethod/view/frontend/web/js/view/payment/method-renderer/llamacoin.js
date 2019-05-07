define([
        'jquery',
        'Magento_Payment/js/view/payment/cc-form'
    ],
    function ($, Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Iz_CustomPaymentMethod/payment/llamacoin'
            },

            context: function() {
                return this;
            },

            getCode: function() {
                return 'classyllama_llamacoin';
            },

            isActive: function() {
                return true;
            }
        });
    }
);
