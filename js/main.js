$(document).ready(function(){
	
	var flashCards = [
		{front:"1 + 1 = _",		back:"2"},
		{front:"a,b,c,d,_ ?",	back:"e"},
		{front:"dat front",		back:"dat back"}
	];
	
	var deck = flashCards.filter(function(){return true;});  // cards belong in the deck, until they are discarded
	var discard = [];
	
	var cardFrame = {
		currentCardIndex: 0,
		currentCard: null,
		element: $("#flashcard p"),
		state: "unflipped", // flipped or unflipped

		initialize: function(){
			this.currentCard = deck[this.currentCardIndex];
			this.showFront();
		},
		
		showFront: function(){
			this.element.text( this.currentCard.front );
		},
		
		flip: function(){
			if( this.state == "unflipped" ){
				this.element.text( this.currentCard.back );
				this.state = "flipped";
			}else{
				this.element.text( this.currentCard.front );
				this.state = "unflipped";
			}
		},
		
		nextCard: function(){
			
		}
	};
	
	// Initializes board
	(function initialize(){ 
		refreshCounter(1);
		
		cardFrame.initialize();
		$("#flashcard").bind( "click", function(){cardFrame.flip();} );
		$("#btn-correct").bind( "click", function(){
			discard.push( deck.shift() );
			cardFrame.initialize();
			console.log("correct");
		} );
		$("#btn-incorrect").bind( "click", function(){
			
		} );
		$("#btn-skip").bind( "click", function(){} );

		
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