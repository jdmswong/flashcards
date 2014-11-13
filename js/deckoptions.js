$(document).ready(function(){

$("#select-all").click( toggleSelectAll );

function toggleSelectAll(){
    if( $("#select-all").prop("checked") == true ){
        $("input[name=deckid]").prop("checked",true);
    }else{
        $("input[name=deckid]").prop("checked",false);
    }
}

});