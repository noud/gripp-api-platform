require.config({
    paths: {
        vis: 'vis',
    }
});
require(['vis'], function (math) {
    require('vis/dist/vis.css');
    DataSet = require('vis/lib/DataSet');
    Timeline = require('vis/lib/timeline/Timeline');

    var container = document.getElementById('visualization');
    var dataSet = jQuery('#visualization').data('data-set');
    var items = new DataSet(dataSet);
    var options = {};    // @TODO how to make the timeline height and width dynamic?
    var timeline = new Timeline(container, items, options);
});