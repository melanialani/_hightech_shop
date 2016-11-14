/**
 * Created by MESHIANG on 12/5/2015.
 */
$(document).ready(function(){
    $('.ui.dropdown').dropdown();
    $('.menu .browse')
        .popup({
            inline   : true,
            hoverable: true,
            position : 'bottom left',
            delay: {
                show: 300,
                hide: 800
            }
        })
    ;
});


