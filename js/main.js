$(document).ready(function(){
	
	var flashCards = [
		{front:"1 + 1 = _",		back:"2"},
		{front:"a,b,c,d,_ ?",	back:"e"},
		{front:"dat front",		back:"dat back"}
	];
	
	var cardFrame = {
		currentCard: flashCards[0],
		element: $("#flashcard"),
		showFront: function(){
			$("#flashcard").text( this.currentCard.front );
		}
	};
	
	// Initializes board
	(function initialize(){ 
		refreshCounter(1);
		
		cardFrame.showFront();
	})();
	
	// Sets counter to "x of <total>"
	function refreshCounter(currentCount){
		$(" #counter ").text(currentCount + " of " +flashCards.length);
	}
	
});