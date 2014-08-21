$(document).ready(function(){
	
	var flashCards = [
		{front:"1 + 1 = _",		back:"2"},
		{front:"a,b,c,d,_ ?",	back:"e"},
		{front:"dat front",		back:"dat back"}
	];
	
	var cardFrame = {
		currentCard: flashCards[0],
		element: "asdf",//$("#flashcard p"),
		state: "unflipped", // flipped or unflipped
		initialize: function(){
			
			this.showFront();
			
			
		},
		
		showFront: function(){
			console.log("showfront: "+this.element);
			//this.element.text( this.currentCard.front );
		},
		
		flip: function(){
			console.log("flip: "+this.element);
			//this.element.text( this.currentCard.back );
		},
	};
	
	// Initializes board
	(function initialize(){ 
		refreshCounter(1);
		
		cardFrame.initialize();
			$("#flashcard").bind( "click", function(){alert(this.element);} );
		
		// Debug menu
		$("#debug button").bind( "click", function(){
			cardFrame.flip();
		} );
	})();
	
	// Sets counter to "x of <total>"
	function refreshCounter(currentCount){
		$(" #counter ").text(currentCount + " of " +flashCards.length);
	}
	
});