/**
 * Created by boozz on 2/8/15.
 */

(function($){
    setInterval(function(){
        if ( window.location.hash == "#save-success") {
            history.pushState('', document.title, window.location.pathname);
            $('#ok-alert').show(100);
            setTimeout(function(){ $('#ok-alert').hide(100); },4000);
        }
        if ( window.location.hash == "#remove-success") {
            history.pushState('', document.title, window.location.pathname);
            $('#warning-alert').show(100);
            setTimeout(function(){ $('#warning-alert').hide(100); },4000);
        }
    },200);
})(jQuery);
