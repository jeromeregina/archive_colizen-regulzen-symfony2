 $(function(){
     var $timepickers = $('.timepicker');
 
    $timepickers.each(function(){
        if($(this).type !== 'time'){
            $(this).timepicker({
                showSeconds: false,
                showMeridian: false
                }).next().on('click', function(){$(this).prev().focus();});
        }
    });


 });