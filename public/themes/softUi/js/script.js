$(document).ready(function(){
    $('li.nav-item a, button[type="button"]').click(function(e){
        var ini = $(this);
        var bs_toggle = ini.data('bs-toggle');
        var target = ini.attr('aria-controls');

        if(bs_toggle == 'collapse')
            e.preventDefault();
        else
            return;
        
        var sub = $( "#"+ target);
        console.log(sub);
        if(sub.hasClass('show'))
            sub.removeClass('show');
        else
            sub.addClass('show');
        
        
    })

})