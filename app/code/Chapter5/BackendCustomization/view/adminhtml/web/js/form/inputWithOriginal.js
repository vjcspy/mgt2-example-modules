define([
  'Magento_Ui/js/form/element/abstract',
  'mageUtils'
], function (AbstractElement, utils) {
  'use strict';

  return AbstractElement.extend({
    defaults: {

      links: {
        value: '${ $.provider }:${ $.dataScope }'
      }
    },

    initObservable: function () {
      this._super();

      this.originalValue = this.value;

      return this;
    }
  });
});
