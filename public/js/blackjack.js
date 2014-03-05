var suits = ['Harts', 'Wolves', 'Kraken', 'Lions'];
var values = ['Ace', 'King', 'Queen', 'Jack', 'Ten', 'Nine', 'Eight', 'Seven', 'Six',
				'Five', 'Four', 'Three', 'Two'];

var deck = [];

// Build card object
var Card = function (suit, card, isAce, value) {
	suit = this.suit;
	card = this.card;
	isAce = this.isAce;
	value = this.value;
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
				deck.push(card);
			}
		}
	}


buildDeck(suits,values);
console.log(deck);