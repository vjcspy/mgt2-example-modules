define([], function() {
  var updates = {
    // formatPrice: function(amount, format, isShowSign) {
    //   return '00000';
    // }
  };

  return function(target) {
    return Object.assign(target, updates);
  }
});