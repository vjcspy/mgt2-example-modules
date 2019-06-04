define([
  'Magento_Checkout/js/view/payment/default',
  'jquery',
  'mage/validation'
], function (Component, $) {
  'use strict';

  return Component.extend({
    defaults: {
      template: 'Chapter7_PaymentMethod/payment/super-payment-form',
      paymentSenderNumber: ''
    },

    /** @inheritdoc */
    initObservable: function () {
      this._super()
        .observe('paymentSenderNumber');

      return this;
    },

    /**
     * @return {Object}
     */
    getData: function () {
      return {
        method: this.item.method,
        'additional_data': {
          'paymentSenderNumber': this.paymentSenderNumber()
        }
      };
    },

    /**
     * @return {jQuery}
     */
    validate: function () {
      var form = 'form[data-role=super-payments-form]';

      return $(form).validation() && $(form).validation('isValid');
    }
  });
});
