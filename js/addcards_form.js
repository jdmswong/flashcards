$(document).ready(function(){

// TODO check for duplicate deck name when creating new deck. call to php script perhaps?
    
setDeckTitleDisplay();
$("select[name=deck-select]").change( setDeckTitleDisplay );

// Force validation before submission
$("#add-card-form").submit(function(){
    console.log("submit function active");
    
    var errormsg = '';
    if( $("select[name=deck-select]").val() == -1 &&
        $("input[name=new-deck-title-input]").val() == ""
    ){
        errormsg += "Provide a title for your new deck\n";
        console.log("error msg 1 active");
    }
    
    if( $("input[name=inputFile]").val() == '' ){
        errormsg += "Provide a filename";
        console.log("error msg 2 active");
    }
    
    if(errormsg != ''){
        alert(errormsg);
        event.preventDefault();
        
    }
    
});

function setDeckTitleDisplay(){
    if($("select[name=deck-select]").val() != -1 ){
        $("#new-deck-title").css("display","none");
    }else{
        $("#new-deck-title").css("display","block");
    }
    
}
   
});
