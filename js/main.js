$(document).ready(function(){
	
	var flashCards = [
		{front:"1 + 1 = _",		back:"2"},
		{front:"a,b,c,d,_ ?",	back:"e"},
		{front:"dat front",		back:"dat back"},
		{front:"front4",		back:"back4"},
		{front:"front5",		back:"back5"},
	];
	
	var placeHolderCard = {front:"[No cards]", back:"[No cards]"};
	
	var deck = range(0, flashCards.length-1);  // cards belong in the deck, until they are discarded
	var discard = [];
	var nextDeck = [];
	var roundNum = 1;
	
	var cardFrame = {
		currentCardIndex: null,
		currentCard: null,
		element: $("#flashcard p"),
		state: "unflipped", // flipped or unflipped

		initialize: function(){
			
			if(undefined){
				console.log("deck:");
				console.log(deck);
				console.log("discard:");
				console.log(discard);
				console.log("nextDeck");
				console.log(nextDeck);
				console.log();
			}
		
			if(deck.length > 0){
				this.currentCardIndex = deck[0];
				this.currentCard = flashCards[this.currentCardIndex];
			}else{
				this.currentCardIndex = undefined;
				this.currentCard = placeHolderCard;
			}
			this.showFront();
			
			refreshCounter();
			updateRound();
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
			discard.push(deck.shift());
			this.initialize();
			if(deck.length == 0){
				console.log("deck finished");
				this.deckClosure();
			}
		},
		
		incorrect: function(){
			nextDeck.push(deck.shift());
			this.initialize();
			if(deck.length == 0){
				console.log("deck finished");
				this.deckClosure();
			}
		},
		
		skip: function(){
			if(deck.length > 0){
				deck.push(deck.shift());
				this.initialize();
				
			}
		},
		
		deckClosure: function(){
			console.log("discard:");
			console.log(discard);
			console.log("nextDeck");
			console.log(nextDeck);
			
			alert(
				"Round over! " + discard.length + "/" + ( discard.length + nextDeck.length ) 
				+ "correct. " + nextDeck.length + " cards moved to next round"
			);
			
			nextRound();
		},
	};
	
	
	
	// Initializes board
	(function initialize(){ 
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
	
	function nextRound(){
		deck = nextDeck;
		nextDeck = [];
		discard = [];
		incrementRound();
		cardFrame.initialize();
	}
	
	// Sets counter to "x of <total>"
	function refreshCounter(){
		$(" #card-counter ").text(deck.length + " remaining");
	}
	
	function incrementRound(){
		roundNum++;
		updateRound();
	}
	
	function updateRound(){
		$(" #round-counter ").text("Round " + roundNum);
	}
	
	function range(start, end) {
	    var foo = [];
	    for (var i = start; i <= end; i++) {
	        foo.push(i);
	    }
	    return foo;
	}
});