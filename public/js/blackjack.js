var suits = ['Harts', 'Wolves', 'Kraken', 'Lions'];
var values = ['Ace', 'King', 'Queen', 'Jack', 'Ten', 'Nine', 'Eight', 'Seven', 'Six',
				'Five', 'Four', 'Three', 'Two'];

var deck = [];

// function buildDeck(suits, values) {
// 	for(var i = 0; i < values.length; i++) {
// 		for(var j = 0; j < suits.length; j++) {
// 			deck.push(values[i] + " of " + suits[j]);

// 		}
// 	}
// }

//buildDeck(suits, values);

var Card = function (suit, card, isAce, value) {
	suit = this.suit;
	card = this.card;
	isAce = this.isAce;
	value = this.value;
}

Card.getValue = function () {
	this.value
}

// var cardOne = new Card();
// cardOne.suit = "Wolves";
// cardOne.card = "King";
// cardOne.isAce = false;
// cardOne.value = 10;

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
				deck.push(card);
			}
		}
	}


buildDeck(suits,values);
console.log(deck);