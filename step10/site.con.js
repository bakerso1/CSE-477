/*! DO NOT EDIT step10 2017-04-20 */
function Buttons() {
    this.on = 1;
    var that = this;

    this.update(1);

    for(var b=1;  b<=3;  b++) {
        this.configButton(b);
    }
}

Buttons.prototype.configButton = function(b) {
    var c = (b == 3 ? 1 : b + 1);
    var that = this;

    $("#b" + b).click(function() {
        if(that.on == b) {
            that.update(c);
        }
    });
}

Buttons.prototype.update = function(a) {
    this.on = a;
    $("#b1").css("background-color", this.on == 1 ? "red" : "green");
    $("#b2").css("background-color", this.on == 2 ? "red" : "green");
    $("#b3").css("background-color", this.on == 3 ? "red" : "green");
    $("#b1").html(this.on == 1 ? "Press Me" : "&nbsp;");
    $("#b2").html(this.on == 2 ? "Press Me" : "&nbsp;");
    $("#b3").html(this.on == 3 ? "Press Me" : "&nbsp;");
}

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
    this.current = 0;
    this.ValueSim = [];    // Simon says
    this.ValueUser = []; // User answers
    this.level = 0; // Round
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
                }, 2000);
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
                    }, 2000);
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

Simon.prototype.play = function() {
    this.state = "play";    // State is now playing
    this.current = 0;       // Starting with the first one
    this.playCurrent();
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
