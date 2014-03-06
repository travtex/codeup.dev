var suits = ['Harts', 'Wolves', 'Kraken', 'Lions'];
var values = ['Ace', 'King', 'Queen', 'Jack', 'Ten', 'Nine', 'Eight', 'Seven', 'Six',
				'Five', 'Four', 'Three', 'Two'];

var deck = [];
var playerHand = [];
var dealerHand = [];
var playerScore = 0;
var dealerScore = 0;


// Build card object
var Card = function (suit, card, isAce, value, id) {
	this.suit = suit;
	this.card = card;;
	this.isAce = isAce;
	this.value = value;
	this.id = id;

}

// card1.style['background-image'] = "url('../img/cards/king-of-wolves.jpg')";
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
				card.id = String(i) + String(j);
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
// build and shuffle deck
buildDeck(suits,values);
// deck.shuffle();

var addCard = function(hand) {
	return hand.push(dealCard(deck));
}

// addCard(playerHand);
// addCard(playerHand);
// addCard(playerHand);
// addCard(playerHand);


// console.log(playerHand);


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


// console.log(scoreHand(playerHand));

// Testing
console.log(deck);

