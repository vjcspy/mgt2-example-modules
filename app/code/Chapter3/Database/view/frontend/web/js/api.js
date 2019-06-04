define([], function() {
  return {
    getItems: function() {
      return fetch('/rest/V1/discounts?criteria=null', {
        credentials: 'include',
        headers: {
          'Accept': 'application/json, text/plain, */*',
          'Content-Type': 'application/json'
        }
      }).then(function(response) { return response.json() });
    },

    getItem: function(id) {
      return fetch('/rest/V1/discount/' + id, {
        credentials: 'include',
        headers: {
          'Accept': 'application/json, text/plain, */*',
          'Content-Type': 'application/json'
        }
      }).then(function (response) {
        return response.json()
      }).then(function(item) {
        return [item];
      });
    },

    search: function(field, value, conditionType) {
      const url = '/rest/V1/discount/?' +
        'criteria[filter_groups][0][filters][0][field]=' + field + '&' +
        'criteria[filter_groups][0][filters][0][value]=' + value + '&' +
        'criteria[filter_groups][0][filters][0][condition_type]=' + conditionType;

      return fetch(url, {
        credentials: 'include',
        headers: {
          'Accept': 'application/json, text/plain, */*',
          'Content-Type': 'application/json'
        }
      }).then(function(response) { return response.json() });
    }
  };
});