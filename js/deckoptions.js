$(document).ready(function(){

refreshButtonVisibility();

$("input[name=deckid]").click( refreshButtonVisibility );
$("#select-all").click( toggleSelectAll );

function toggleSelectAll(){
    if( $("#select-all").prop("checked") == true ){
        $("input[name=deckid]").prop("checked",true);
    }else{
        $("input[name=deckid]").prop("checked",false);
    }
    refreshButtonVisibility();
}

$("#btn-delete").click( deleteAction );

function deleteAction(){
    window.location = "deckaction.php?action=delete&deckids="+getDeckIDs();
}

function getDeckIDs(){
    return $("input[name=deckid]:checked").map( function(){
        return this.value; 
    }).get().join(); 
}

function refreshButtonVisibility(){
    if( 
        $("input[name=deckid]").map( function(){ 
            return $(this).prop("checked");
        } ).get().indexOf(true) == -1 
    ){
        $("#btn-delete").hide();
    }else{
        $("#btn-delete").show();
    }
}

});