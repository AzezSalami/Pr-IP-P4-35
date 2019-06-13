
/*    N. Eenink, A. Salami, I. Hamoudi            */
/*    M. Vermeulen, D. Haverkamp & J. van Vugt    */
/*    HAN ICA HBO ICT - IProject, 13-06-2019      */

$(document).ready(function(){
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 200,
            values: [ 50, 150 ],
            slide: function( event, ui ) {
                $( "#amount-min" ).val(ui.values[ 0 ] );
                $( "#amount-max" ).val(ui.values[ 1 ] );
            }
        });

        $("#amount-min").change(function() {
            $("#slider-range").slider('values',0,$(this).val());
        }).css({width: "100%"});
        $("#amount-max").change(function() {
            $("#slider-range").slider('values',1,$(this).val());
        }).css({width: "100%"});
    } );
});

