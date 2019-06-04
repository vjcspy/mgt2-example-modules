define([
    'Magento_Ui/js/grid/columns/column',
    'jquery',
    'mage/template',
    'underscore',
    'mage/translate'
], function (Column, $, mageTemplate, thumbnailPreviewTemplate, _) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Chapter5_BackendCustomization/grid/combinedName'
        },

        getText: function (row) {
            console.log(row);
            return row['firstname'] + ' ' + row['lastname'];
        }
    });
});
