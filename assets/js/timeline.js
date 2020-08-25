import 'vis-timeline/styles/vis-timeline-graph2d.min.css';
import { Timeline } from "vis-timeline";
var timeline = null;
$( document ).ready(function() {
    var container = document.getElementById('visualization');
    if (container != null) {
        var drawn = $('#visualization').data('drawn');
        if (false === drawn) {
            container.dataset.drawn = true;
            var items = $('#visualization').data('dataset');
            container.dataset.dataset = [];
            var options = {};    // @TODO how to make the timeline height and width dynamic?
            timeline = new Timeline(container, items, options);
            if (container.childElementCount === 2) {
                container.removeChild(container.lastElementChild);
            }
        }
    }
});