/**
 * API useful functions
 *
 */

var apiConfig = require('./apiConfig.js');

module.exports = {
    'apiUrl': apiConfig.apiUrl,
    'cityUrl': '/city/id/',
    'areaUrl': '/area/id/',
    'regionUrl': '/region/id/',
    'countryUrl': '/country/id/',

    parseId: function(tableName, records){
        records.forEach(function(record){
            var me = Object.getOwnPropertyDescriptor(record, 'id');
            var city = Object.getOwnPropertyDescriptor(record, 'city_id');
            var area = Object.getOwnPropertyDescriptor(record, 'area_id');
            var region = Object.getOwnPropertyDescriptor(record, 'region_id');
            var country = Object.getOwnPropertyDescriptor(record, 'country_id');

            if(typeof city !== 'undefined'){
                record.city_id = this.apiUrl + this.areaUrl + city.value;
            }

            if(typeof area !== 'undefined'){
                record.area_id = this.apiUrl + this.areaUrl + area.value;
            }

            if(typeof region !== 'undefined'){
                record.region_id = this.apiUrl + this.regionUrl + region.value;
            }

            if(typeof country !== 'undefined'){
                record.country_id = this.apiUrl + this.countryUrl + country.value;
            }

            if(typeof me !== 'undefined'){
                var meUrl = '/' + this.tableName + '/id/';
                record.id = this.apiUrl + meUrl + me.value;
            }

        }, this);

        return records;
  }
}
