$(document).ready(function(){
	
	var flashCards = [
		{front:"1 + 1 = _",		back:"2"},
		{front:"a,b,c,d,_ ?",	back:"e"},
		{front:"dat front",		back:"dat back"}
	];
	
	var deck = [0,1,2];  // cards belong in the deck, until they are discarded
	var discard = [];
	var nextDeck = [];
	
	var cardFrame = {
		currentCardIndex: null,
		currentCard: null,
		deckIndex : 0,
		element: $("#flashcard p"),
		state: "unflipped", // flipped or unflipped

		initialize: function(){
			this.currentCardIndex = deck[this.deckIndex];
			this.currentCard = flashCards[this.currentCardIndex];
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
		
		correct: function(){
			discard.push(deck[this.deckIndex]);
			this.deckIndex++;
			this.initialize();
		}
	};
	
	// Initializes board
	(function initialize(){ 
		refreshCounter(1);
		
		cardFrame.initialize();
		$("#flashcard").bind( "click", function(){cardFrame.flip();} );
		$("#btn-correct").bind( "click", function(){cardFrame.correct();} );
		$("#btn-incorrect").bind( "click", function(){cardFrame.incorrect();} );
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