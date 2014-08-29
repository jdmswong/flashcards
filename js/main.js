$(document).ready(function(){
	
	var flashCards = [
		{front:"1 + 1 = _",		back:"2"},
		{front:"a,b,c,d,_ ?",	back:"e"},
		{front:"dat front",		back:"dat back"},
		{front:"front4",		back:"back4"},
		{front:"front5",		back:"back5"},
	];
	
	var deck = range(0, flashCards.length-1);  // cards belong in the deck, until they are discarded
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
			
			console.log("deck:");
			console.log(deck);
			console.log("discard:");
			console.log(discard);
			console.log("nextDeck");
			console.log(nextDeck);
			console.log();
		
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
		
		skip: function(){
			deck.push(deck.shift());
			this.initialize();
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
		$("#flashcard")		.on( "click", function(){cardFrame.flip();} );
		$("#btn-correct")	.on( "click", function(){cardFrame.correct();} );
		$("#btn-incorrect")	.on( "click", function(){cardFrame.incorrect();} );
		$("#btn-skip")		.on( "click", function(){cardFrame.skip();} );

		
		// Debug menu
		$("#debug button").on( "click", function(){
			cardFrame.flip();
		} );
	})();
	
	// Sets counter to "x of <total>"
	function refreshCounter(currentCount){
		$(" #counter ").text(currentCount + " of " +flashCards.length);
	}
	
	function range(start, end) {
	    var foo = [];
	    for (var i = start; i <= end; i++) {
	        foo.push(i);
	    }
	    return foo;
	}
});