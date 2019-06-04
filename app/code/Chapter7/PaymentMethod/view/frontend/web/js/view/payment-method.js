define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
], function (Component, rendererList) {
    'use strict';

    rendererList.push(
      {
          type: 'super_payments',
          component: 'Chapter7_PaymentMethod/js/view/renderer'
      }
    );

    return Component.extend({});
});
