var suits = ['Harts', 'Wolves', 'Kraken', 'Lions'];
var values = ['Ace', 'King', 'Queen', 'Jack', 'Ten', 'Nine', 'Eight', 'Seven', 'Six',
				'Five', 'Four', 'Three', 'Two'];

var deck = [];
var playerHand = [];
var dealerHand = [];
var playerScore = 0;
var dealerScore = 0;


// Build card object
var Card = function (suit, card, isAce, value, image) {
	this.suit = suit;
	this.card = card;
	this.isAce = isAce;
	this.value = value;
	this.image = image;

}
	
// Get the numeric value of a given card name
var getValue = function (card) {
	switch (card) {
		case "Ace":
			return 11;
			break;
		case "King":
		case "Queen":
		case "Jack":
		case "Ten":
			return 10;
			break;
		case "Nine":
			return 9;
			break;
		case "Eight":
			return 8;
			break;
		case "Seven":
			return 7;
			break;
		case "Six":
			return 6;
			break;
		case "Five":
			return 5;
			break;
		case "Four":
			return 4;
			break;
		case "Three":
			return 3;
			break;
		case "Two":
			return 2;
			break;
	}
}

// Populate an array of card objects, setting values for fresh deck
function buildDeck(suits, values) {
	for(var i = 0; i < values.length; i++) {
		for(var j = 0; j < suits.length; j++) {
			var card = new Card();
				card.suit = suits[j];
				card.card = values[i];
				if(values[i] == "Ace") {
					card.isAce = true;
				} else {
					card.isAce = false;
				}
				card.value = getValue(values[i]);
				card.image = '..\/img\/cards\/' + values[i].toLowerCase() + '-of-' + suits[j].toLowerCase() + '.jpg';
				
				deck.push(card);
		}
	}
}

// Fisher-Yates algorithm for randomizing an Array

Array.prototype.shuffle = function() {
  var i = this.length;
  var j; 
  var temp;
  if ( i == 0 ) return this;
  while ( --i ) {
     j = Math.floor( Math.random() * ( i + 1 ) );
     temp = this[i];
     this[i] = this[j];
     this[j] = temp;
  }
  return this;
}

var dealCard = function(deck) {
	return deck.pop();
}

var addCard = function(hand) {
	return hand.push(dealCard(deck));
}

// Read the hand array, check for aces, and return total score

// Return blackjack score of an array of cards, adjust for aces if over 21.

var scoreHand = function(hand) {
	var score = 0;
	var aces = 0;
	for(i = 0; i < hand.length; i++) {
		for(var key in hand[i]) {
			if(key == "value") {
				score += hand[i]["value"];
			}
		}
		if(hand[i].isAce) {
			aces++
		}
	}
	if(score > 21){
		while(aces !== 0 && score > 21) {
			score -= 10;
			aces--;
		}
	}
	return score;
}

// Show player and dealer totals

var showScore = function(player) {
	if(player) {
		score = scoreHand(playerHand);
		$(".player-box h3>span").text(score);
	} else {
		score = scoreHand(dealerHand);
		$(".dealer-box h3>span").text(score);
		
	}
}

// Display results of player loss
var playerLose = function() {
	$("#hit-me").prop("disabled",true).css("opacity", "0.6");
	$("#stand").prop("disabled",true).css("opacity", "0.6");
	$(".dealer-box .turned").removeClass("turned");
	$(".dealer-box h2>span").text("WINS!").effect("highlight", {}, 2500);
	$(".player-box h2>span").text("LOSES!");
}

// Display results of player win

var playerWin = function() {
	$("#hit-me").prop("disabled",true).css("opacity", "0.6");
	$("#stand").prop("disabled",true).css("opacity", "0.6");
	$(".dealer-box .turned").removeClass("turned");
	$(".player-box h2>span").text("WINS!").effect("highlight", {}, 2500);
	$(".dealer-box h2>span").text("LOSES!");
}

// Display results of a push

var playerPush = function() {
	$("#hit-me").prop("disabled",true).css("opacity", "0.6");
	$("#stand").prop("disabled",true).css("opacity", "0.6");
	$(".dealer-box .turned").removeClass("turned");
	$(".dealer-box h2>span").text("PUSH!").effect("highlight", {}, 2500);
	$(".player-box h2>span").text("PUSH!").effect("highligth", {}, 2500);

}

var displayCard = function(dealer, card) {
	if(dealer) {
		$(".dealer-box .card").last().after("<div class=\"card\" style=\"background:url('" + card.image
			+ "'); background-size:cover;\"><\/div>");
	} else {
		$(".player-box .card").last().after("<div class=\"card\" style=\"background:url('" + card.image 
			+ "'); background-size:cover;\"><\/div>");
	}
}

// Hit me button adds card to player hand and gets total

var hitMe = function() {
	addCard(playerHand);
	displayCard(false, playerHand[playerHand.length-1]);
	showScore(true);
	
	if(scoreHand(playerHand) > 21) {
		$(".player-box h3>span").text("Player BUST with " + scoreHand(playerHand));
		playerLose();
		showScore();
	}
}

// Dealer plays hand, must hit under 17 and stay over 17

var dealerTurn = function() {
	dscore = scoreHand(dealerHand);
	pscore = scoreHand(playerHand);
	
	$(".dealer-box .turned").removeClass("turned");
	showScore();
	while(dscore < 17) {
		addCard(dealerHand);
		displayCard(true, dealerHand[dealerHand.length-1]);
		dscore = scoreHand(dealerHand);
		showScore();
	}
	if (dscore > 21) {
		$(".dealer-box h3>span").text("Dealer BUST with " + scoreHand(dealerHand));
		playerWin();
	} else if (dscore === pscore) {
		playerPush();
	} else if (dscore > pscore) {
		playerLose();
	} else {
		playerWin();
	}
}

// Start a new game
var newGame = function(){
	// Initialize variables
	deck = [];
	playerHand = [];
	dealerHand = [];

	// Clear existing cards from playing field
	$(".dealer-box .holder").nextUntil("h3").remove();
	$(".player-box .holder").nextUntil(".player-buttons").remove();

	// Reset buttons and alerts
	$("#hit-me").prop("disabled",false).css("opacity", "1");
	$("#stand").prop("disabled",false).css("opacity", "1");
	$(".dealer-box h3>span").text("");
	$(".player-box h3>span").text("");
	$(".dealer-box h2>span").text("Hand");
	$(".player-box h2>span").text("Hand");
	
	// Rebuild the deck and shuffle the cards
	buildDeck(suits,values);
	deck.shuffle();

	// Deal cards to dealer and player, display cards
	addCard(dealerHand);
	displayCard(true, dealerHand[0]);
	$(".dealer-box .card").addClass("turned");
	addCard(dealerHand);
	displayCard(true, dealerHand[1]);

	addCard(playerHand);
	displayCard(false, playerHand[0]);
	addCard(playerHand);
	displayCard(false, playerHand[1]);
	showScore(true);

}

// build and shuffle deck
// Testing
console.log(deck);

