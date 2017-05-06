/**
 * Created by jaiwant on 4/20/2017.
 */
function Simon(sel) {

    // Get a reference to the form object
    this.form = $(sel);
    this.configureButton(0, "red");
    this.configureButton(1, "green");
    this.configureButton(2, "blue");
    this.configureButton(3, "yellow");

    this.state = "initial";
    this.sequence = []; // Color order


    console.log('Simon started');

    this.ValueSim = [];
    this.ValueUser = [];
    this.level = 0;
    this.current = 0;
    this.sequence.push(Math.floor(Math.random() * 4));

    this.play();

}

Simon.prototype.configureButton = function(ndx, color) {
    var button = $(this.form.find("input").get(ndx));
    var that = this;

    button.click(function(event) {
        document.getElementById(color).currentTime = 0;

        if (that.state === "enter") {
            if (color != that.ValueSim[that.level]) {
                document.getElementById("buzzer").play();
                that.ValueSim = [];
                that.ValueUser = [];
                that.sequence = [];
                that.sequence.push(Math.floor(Math.random() * 4));
                that.level = 0;
                that.state = "restart";

                window.setTimeout(function () {
                    that.play();
                }, 1000);
            }

            if (color === that.ValueSim[that.level]) {
                that.level += 1;
                that.ValueUser.push(color);

                document.getElementById(color).play();

                if (that.level === that.ValueSim.length) {
                    that.ValueSim = [];
                    that.ValueUser = [];
                    that.level = 0;
                    that.sequence.push(Math.floor(Math.random() * 4));

                    window.setTimeout(function () {
                        that.play();
                    }, 1000);
                }
            }
        }
    });

    button.mousedown(function(event) {
        button.css("background-color", color);
    });

    button.mouseup(function(event) {
        button.css("background-color", "lightgrey");
    });
};



Simon.prototype.playCurrent = function() {
    var that = this;

    if(that.current < that.sequence.length) {
        var colors = ['red', 'green', 'blue', 'yellow'];
        document.getElementById(colors[this.sequence[this.current]]).play();
        this.ValueSim.push(colors[this.sequence[this.current]]);
        this.buttonOn(-1);
        this.buttonOn(this.sequence[this.current]);
        this.current++;
        window.setTimeout(function() {
            that.playCurrent();
        }, 1000);
    } else {
        that.state = "enter";
        this.buttonOn(-1);
    }
};

Simon.prototype.buttonOn = function(button) {
    // Turn off everything
    if (button === -1) {
        var red = $(this.form.find("input").get(0));
        red.css("background-color", "lightgrey");
        var green = $(this.form.find("input").get(1));
        green.css("background-color", "lightgrey");
        var blue = $(this.form.find("input").get(2));
        blue.css("background-color", "lightgrey");
        var yellow = $(this.form.find("input").get(3));
        yellow.css("background-color", "lightgrey");
    }

    // Set button
    else {
        var currButton = $(this.form.find("input").get(button));
        var colors = ['red', 'green', 'blue', 'yellow'];
        var color = (colors[this.sequence[this.current]]);
        currButton.css("background-color", color);
    }
};

Simon.prototype.play = function() {
    this.state = "play";    // State is now playing
    this.current = 0;       // Starting with the first one
    this.playCurrent();
};
