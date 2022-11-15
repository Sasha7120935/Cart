/**
 * cartAjaxUpdate.js
 * @copyright Copyright © 2021 Web4pro. All rights reserved.
 * @author    belousalek2@gmail.com
 */
define([
    'jquery',
    'Magento_Checkout/js/action/get-totals',
    'Magento_Customer/js/customer-data',
    'jquery/ui'
], function ($, getTotalsAction, customerData) {
    "use strict";

    $.widget('mage.cartAjaxUpdate', {
        options: {
            fieldSelectorFist: '.nav-item',
            fieldSelectorSecond: '.product-item-name'
        },
        _create: function () {
            this._bindCart();
        },
        _bindCart: function () {
            var self = this;
            var fieldSelectorFist = $(this.options.fieldSelectorFist)
            var fieldSelectorSecond = $(this.options.fieldSelectorSecond)
            fieldSelectorFist.on('change', function (event) {
                var name = this.value
                $.ajax({
                    url: self.options.urlAjax,
                    type: 'POST',
                    dataType: 'json',
                    data: name,
                    success: function (response) {
                        if(response === name){
                            console.log('yes')
                        } else {
                            fieldSelectorSecond.html(name)
                        }
                        // $.each(response, function (key, value) {
                        //     $('#price-' + key + '-single').find('.price').text(value.price);
                        //     $('#subtotal-' + key + '-sin').find('.price').text(value.row_total);
                        // });
                        // var sections = ['cart'];
                        // customerData.reload(sections, true);
                        //
                        // var deferred = $.Deferred();
                        // getTotalsAction([], deferred);
                    }
                });
            })
        }
    });
    return $.mage.cartAjaxUpdate;
});
