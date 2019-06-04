define([
  'Magento_Ui/js/grid/listing',
  'ko',
  'uiLayout',
  'Magento_Ui/js/modal/prompt'
], function(Component, ko, layout, prompt) {
  'use strict';

  const detailsUrl = '/rest/V1/carts/mine',
    fetchUrl = '/rest/default/V1/carts/mine/items',
    addUrl = '/rest/default/V1/carts/mine/items',
    deleteUrl = '/rest/V1/carts/mine/items/';

  let self = null;

  return Component.extend({
    defaults: {
      template: 'Chapter7_QuoteApi/item',
      tracks: {
        items: true
      },
    },

    initBindings: function() {
      self = this;

      this.addItemEl = document.querySelector('.add-item');
      this.addItemEl.addEventListener('click', this.addItem.bind(this));
    },

    deleteItem: function(row) {
      fetch(deleteUrl + row.item_id, {
        method: 'DELETE',
        credentials: 'include',
        headers: {
          'content-type': 'application/json',
          'x-requested-with': 'XMLHttpRequest'
        }
      }).then(response => response.text())
        .then(function(response) {
          console.log(response);
          self.refresh();
        });
    },

    addItem: function() {
      prompt({
        'title': 'Please provide a SKU:',
        'content': 'Example: 240-LV05',
        'actions' : {
          confirm: sku => this.triggerAdd(sku)
        }
      });
    },

    triggerAdd: function(sku) {
      fetch(addUrl, {
        body: JSON.stringify({
          "cartItem": {
            "sku": sku,
            "qty": 1,
            "quote_id": this.cartId
          }
        }),
        method: 'POST',
        credentials: 'include',
        headers: {
          'content-type': 'application/json',
          'x-requested-with': 'XMLHttpRequest'
        }
      }).then(response => response.json())
        .then(function(response) {
          console.log(response);
          this.refresh();
        }.bind(this));
    },

    addCoupon: function() {
      console.log('add coupon');
    },

    refresh: function(details) {
      if (details && details.hasOwnProperty('id')) {
        this.cartId = details.id;
      }

      if (details && details.hasOwnProperty('items')) {
        this.items = details.items;
        return;
      }

      fetch(fetchUrl, {
        credentials: 'include',
        headers: {
          'x-requested-with': 'XMLHttpRequest'
        }
      }).then(response => response.json())
        .then(response => {
          console.log(response);
          this.items = response
        });
    },

    initObservable: function () {
      this._super();

      fetch(detailsUrl, {
        credentials: 'include',
        headers: {
          'x-requested-with': 'XMLHttpRequest'
        }
      }).then(response => response.json())
        .then(response => this.refresh(response));


      this.initBindings();

      return this;
    }
  });
});
