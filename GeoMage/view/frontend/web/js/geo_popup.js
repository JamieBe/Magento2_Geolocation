define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/modal',
    'Magento_Customer/js/customer-data'
], function (Component, $, modal, storage) {
    'use strict';
 
    var cacheKey = 'geo-popup';
 
    var getData = function () {
        return storage.get(cacheKey)();
    };
 
    var saveData = function (data) {
        storage.set(cacheKey, data);
    };
 
    if ($.isEmptyObject(getData())) {
        var geo_popup = {
            'geo_popup': false
        };
        saveData(geo_popup);
    }
 
    return Component.extend({
 
        initialize: function () {
 
            this._super();
            var options = {
                type: popup,
                responsive: true,
                innerScroll: false,
                title: false,
                buttons: false
            };
 
            var geo_popup_element = $('#geo-popup');
            var popup = modal(options, geo_popup_element);
 
            geo_popup_element.css("display", "block");
 
            this.openModalGeoPopup();
 
        },
 
        openModalGeoPopup:function(){
            var modalContainer = $("#geo-popup");
 
            if(this.getGeoPopup()) {
               return false;
            }
            this.setGeoPopup(true);
            modalContainer.modal('geoPopup');
        },
 
        setGeoPopup: function (data) {
            var obj = getData();
            obj.geo_popup = data;
            saveData(obj);
        },
 
        getGeoPopup: function () {
            return getData().geo_popup;
        }
 
    });
});