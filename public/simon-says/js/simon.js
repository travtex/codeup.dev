
// Game object

var simon = {
	diff: 1,
	score: 0,
	level: 1,
	event: false,  // Click and sound event handler initialization check.
	active: false, // Check if active pad
	button: '.button',

	gameSeq: [], // Array for the game correct button sequence
	playSeq: [], // Array for player's clicked sequence

	begin: function() {
		if(this.event === false) {
			this.clickHandler();
		}
		this.gamePlay();
	},

	
	// Get correct pad and handle animation and sound for that pad
	clickHandler: function() {
		var that = this;
		$('.pads').on('click', function() {
			if (that.active === true) {
				var pad = parseInt($(this).data('pad'));
				that.flash($(this), 1, 400, pad);
				that.playerLog(pad);
			}
		});
		this.event = true;
	},

	// Make button light up and play sound

	flash: function(el, num, rate, button) {
		var that = this;
		if (num > 0) {
			that.soundPlay(button);
			el.stop().animate({opacity: '1'}, {
				duration: 100,
				complete: function () {
					el.stop().animate({opacity: '0.5'}, 200);
				}
			});
		}

		if (num >0) {
			setTimeout(function () {
				that.flash(el, num, rate, button);
			}, rate);
			num -= 1;
		}
	},

	// Get correct sound file and play
	soundPlay: function(mp) {
		var sound = $('.sound' + mp)[0];
		sound.currentTime = 0;				
		sound.play();
	},

	// New game init
	gamePlay: function() {
		this.level = 1;
		this.score = 0;
		this.newLev();
		this.getLevel();
		this.getScore();
	},

	// New game level for next sequence
	newLev: function() {
		this.gameSeq.length = 0;
		this.playSeq.length = 0;
		this.pos = 0;
		this.turn = 0;
		this.active = true;
		
		this.randomPad(this.level); 
		this.showSeq(); 

	},

	// Get a random game pad
	randomPad: function(num) {
		for(var i = 0; i < num; i++) {
			this.gameSeq.push(Math.floor(Math.random() * 4) + 1);
		}
	},

	// Store player's click
	playerLog: function(button) {
		this.playSeq.push(button);
		this.checkSeq(button);
	},

	checkSeq: function(button) {			

		var that = this;

		if(button !== this.gameSeq[this.turn]) {	 
				this.wrongSeq();
		} else {									
			this.addScore();					
			this.turn++;						

		}

		if(this.turn === this.gameSeq.length){	
			
			this.level++;							
			this.getLevel();
			this.active = false;
			setTimeout(function() {
				that.newLev();
			},1000);
		}
	},

	showSeq: function() {					
		var that=this;
		$.each(this.gameSeq, function(key, value) {		
			
			setTimeout(function(){
				that.flash($(that.button + value), 1, 300, value);
			},500 * key * that.diff);				
		});
	},

	getLevel: function() {							
		$('.level h2').text('Level: ' + this.level);
	},

	getScore: function(){							
		$('.score h2').text('Score: '+this.score);
	},

	addScore: function(){								
		var multiplier = 0;

		switch(this.diff)							
		{
			case '2':
				multiplier=1;
				break;
			
			case '1':
				multiplier=2;
				break;

			case '0.25':
				multiplier = 4;
				break;
		}

		this.score += (1 * multiplier);				
		this.getScore();							
	},
	
	wrongSeq: function(){						

		var right = this.gameSeq[this.turn],		
			
			that = this;
			this.active = false;
			this.getLevel();
			this.getScore();

		setTimeout(function(){
		// Three flashes to show correct button							
			that.flash($(that.button + right), 3, 300, right);
		}, 500);

		$('.start').show();								
		$('.diff').show();

	}

}


$(document).ready( function() {
	$('.start').on('click', function() {
		$(this).hide();
		simon.diff = $('input[name = diff]:checked').val();
		$('.diff').hide();
		simon.begin();
	})
})