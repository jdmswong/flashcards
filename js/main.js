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
			if(this.deckIndex == deck.length){
				console.log("deck finished");
				this.deckClosure();
			}else{
				this.initialize();
			}
		},
		
		incorrect: function(){
			nextDeck.push(deck[this.deckIndex]);
			this.deckIndex++;
			if(this.deckIndex == deck.length){
				console.log("deck finished");
				this.deckClosure();
			}else{
				this.initialize();
			}
		},
		
		deckClosure: function(){
			console.log(nextDeck);
			console.log(discard);
		},
	};
	
	// Initializes board
	(function initialize(){ 
		refreshCounter(1);
		
		cardFrame.initialize();
		$("#flashcard").on( "click", function(){cardFrame.flip();} );
		$("#btn-correct").on( "click", function(){cardFrame.correct();} );
		$("#btn-incorrect").on( "click", function(){cardFrame.incorrect();} );
		$("#btn-skip").on( "click", function(){} );

		
		// Debug menu
		$("#debug button").on( "click", function(){
			cardFrame.flip();
		} );
	})();
	
	// Sets counter to "x of <total>"
	function refreshCounter(currentCount){
		$(" #counter ").text(currentCount + " of " +flashCards.length);
	}
	
});