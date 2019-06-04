define([
  'Magento_Ui/js/grid/listing',
  'ko',
  'Chapter3_Database/js/api',
  'Magento_Ui/js/modal/prompt'
], function(Component, ko, Api, prompt) {
  'use strict';

  return Component.extend({
    defaults: {
      template: 'Chapter3_Database/discount/list',
      tracks: {
        items: true,
        field: true,
        value: true,
        conditionType: true
      }
    },

    initialize: function () {
      this._super();
      return this;
    },

    initObservable: function () {
      this.loadItems();

      this._super();
      return this;
    },

    hydrate: function(items) {
      this.items = items.hasOwnProperty('items') ? items.items : items;
    },

    error: function() {
      this.items = [];
    },

    loadItems: function() {
      Api.getItems().then(this.hydrate.bind(this), this.error.bind(this));
    },

    search: function() {
      Api.search(this.field, this.value, this.conditionType)
        .then(this.hydrate.bind(this), this.error.bind(this));
    },

    loadItem: function() {
      prompt({
        'title': 'ID, please:',
        'content': 'What ID do you want to load?',
        'actions': {
          confirm: function(id) {
            Api.getItem(id).then(this.hydrate.bind(this), this.error.bind(this));
          }.bind(this)
        }
      });
    }
  });
});