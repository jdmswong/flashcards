$(document).ready(function(){

    // Log user out
    $("#logout").click(function(){
        $.removeCookie('userid', { path: '/' });
        $.removeCookie('name', { path: '/' });
    });
    
});