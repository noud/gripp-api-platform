import 'vis-timeline/styles/vis-timeline-graph2d.min.css';
import { Timeline } from "vis-timeline";
var timeline = null;
$( document ).ready(function() {
    var container = document.getElementById('visualization');
    if (container.childElementCount === 0) {
            var items = $('#visualization').data('dataset');
            var options = {};    // @TODO how to make the timeline height and width dynamic?
            timeline = new Timeline(container, items, options);
    }
});