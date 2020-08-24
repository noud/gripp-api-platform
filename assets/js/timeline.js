import 'vis-timeline/styles/vis-timeline-graph2d.min.css';
import { Timeline } from "vis-timeline";
$( document ).ready(function() {
    console.log('timeline.start1');
    var container = document.getElementById('visualization');
    if (container != null) {
        var drawn = $('#visualization').data('drawn');
        if (false === drawn) {
            console.log('drawn',drawn);
            document.getElementById('visualization').setAttribute('data', "drawn: 'true'");
            document.getElementById('visualization').dataset.drawn = "true";
            var items = $('#visualization').data('data-set');
            console.log('items',items);
            var options = {};    // @TODO how to make the timeline height and width dynamic?
            console.log('timeline.start2');
            new Timeline(container, items, options);
        }
    }
});