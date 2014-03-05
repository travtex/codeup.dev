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
	suit = this.suit;
	card = this.card;
	isAce = this.isAce;
	value = this.value;
	id = this.id;
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
deck.shuffle();

// var scoreHand = function(hand) {
// 	hand.forEach(function(element, index, array) {
// 		score += hand[index.value];
// 	});
// 	return score;
// }

playerHand.push(dealCard(deck));
playerHand.push(dealCard(deck));

console.log(playerHand);

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

	// while(score > 21)

	return aces;
}

console.log(scoreHand(playerHand));

//console.log(playerCardTwo);
// console.log(scoreHand(playerHand));
// playerTotal = playerCardOne.value + playerCardTwo.value;
// console.log(playerTotal);

// Testing
console.log(deck);

