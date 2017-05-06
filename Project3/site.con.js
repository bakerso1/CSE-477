/*! DO NOT EDIT project3 2017-05-03 */
/**
 * Created by Sndrew on 4/29/17.
 */
function Steampunked(sel){
    var that = this;
    this.sel = $(sel);
    this.grid;

    this.init = function(){
        this.sel.html('<div class="title"><h1>STEAMPUNKED</h1><p><label for="name1">Player one:  </label><input type="text" name="name1" id="name1"></p><p><label for="name2">Player two:  </label><input type="text" name="name2" id="name2"></p> <p><input type="submit"name="start_game" value="Start Game"></p> <div>' +
            '<p>6x6<input type="radio" value="6" name="size">10x10<input type="radio" value="10" name="size">20x20<input type="radio" value="20" name="size"> </p></div>')

        $(this.sel.find("input[type='submit']")).click(function(b){
            b.preventDefault();
            var name1 = $($(that.sel.find("input[type='text']"))[0]).val();
            var name2 = $($(that.sel.find("input[type='text']"))[1]).val();
            var size = $($(that.sel.find("input[name='size']:checked"))).val();

            if(!name1){
                name1 = "player1";
            }
            if(!name2){
                name2 = "player2";
            }
            if (size) {
                size = parseInt(size)
            } else{
                size = 6
            }
            that.sel.html('<div class="game"></div><div class="message"></div><div class="bottom"></div>');
            that.startGame(name1, name2, size);
        })
    };

    this.startGame = function(name1, name2, size){
        this.grid = new Grid(size, '.game', name1, name2, this.sel);
        this.grid.init();
    };
    this.init()
}

function StartingLayout(sel){
    var that = this;
    this.sel = $(sel);

    this.init = function(){
        this.sel.html('<p><label for="name1">Player one:  </label><input type="text" name="name1" id="name1"></p><p><label for="name2">Player two:  </label><input type="text" name="name2" id="name2"></p> <p><input type="submit"name="start_game" value="Start Game"></p> <div>' +
            '<p>6x6<input type="radio" value="6" name="size">10x10<input type="radio" value="10" name="size">20x20<input type="radio" value="20" name="size"> </p></div>')
        $(this.sel.find("input[type='submit']")).click(function(b){
            b.preventDefault()
        })
    }
}

function Grid(size, sel, p1, p2, form){
    var that = this;

    this.form = $(form);
    this.players = [p2,p1];
    this.message = $('.message');
    this.field = [];
    this.size = size;
    this.sel = $('.game');
    this.buttons = [[],[]];
    this.cp = 0;
    this.nextcp = 1;
    this.bottomRow = new BottomRow('.bottom', this);
    this.isDone = [false, false];

    this.checkWin = function(){
        if(($('#'+this.cp)).length === 0){
            if(this.isDone[this.cp]){
                return true
                console.log("allgoo")
            }
            console.log("no smoke")
        }
        if(this.isDone[this.cp]){
            console.log("reached end")
        }
        console.log("nither")
        return false
    };

    this.init = function(startpipes){
        this.bottomRow.init();
        this.bottomRow.display();

        for(var i = 0; i< this.size; i++){
            this.field.push(Array(this.size+2));
        }
        this.displayInit();

        var pipes = new Pipes();
        var startPipes = pipes.startPipes();

        var middle = this.size/2; //3
        var top = middle-3; // 3-3
        var top2 = middle-2; //2
        var bottom = middle+2;
        var bottom2 = middle+1;
        var end = this.size + 1;

        var smoke1 = pipes.makeSmoke(0);
        var smoke2 = pipes.makeSmoke(0);
        smoke1.isSmoke = true;
        smoke2.isSmoke = true;
        smoke1.cp = this.cp;
        smoke2.cp = this.nextcp;

        that.field[top][1] = smoke1;
        that.field[bottom][1] = smoke2;

        this.buttons[this.nextcp].push([bottom, 1]);
        this.buttons[this.cp].push([top, 1]);
        startPipes[1].isEnd = true;

        this.addStart(top, end, startPipes[2]);
        this.addStart(top2, end, startPipes[1]);
        this.addStart(top, 0, startPipes[0]);
        this.changeCP();
        this.addStart(middle, end, startPipes[2]);
        this.addStart(bottom2, end, startPipes[1]);
        this.addStart(bottom, 0, startPipes[0]);
        this.changeTurn();
        this.changeTurn();

        this.message.html("<p>It is " + this.players[this.cp] + "'s turn!")
    };

    this.changeCP = function(){
        cp = this.cp;
        this.cp = this.nextcp;
        this.nextcp = cp;
        this.message.html("<p>It is " + this.players[this.cp] + "'s turn!")
    };

    this.addStart = function(row, column, pipe){
        var box = $($(this.sel.find('.row')[row]).find('.cell')[column]);
        var image = pipe.display();
        box.html("<img src='"+image+"'>");
        this.field[row][column] = pipe;
    };

    this.addPipe = function(row, col){
        var radioValue = $("input[name='pipe']:checked").val();
        if(radioValue){
            var pipe = this.bottomRow.copyIt(radioValue);
            if(this.doesItConnect(pipe, row, col) === true){
                var pipe = this.bottomRow.popIt(radioValue);
                var box = $($(this.sel.find('.row')[row]).find('.cell')[col]);
                var image = pipe.display();
                box.html("<img src='"+image+"'>");
                this.field[row][col] = pipe;
                this.makeSmoke(pipe, row, col);
                return true;

            }else{
                return false
            }
        }
        return false;
    };

    this.makeSmoke = function(pipe, row, col){
        row = parseInt(row);
        col = parseInt(col);
        var open = pipe.getOpen();
        var adds = [[row, col+1], [row+1, col], [row, col-1], [row-1, col]];
        for(var i = 0; i < open.length; i++){
            var rc = adds[open[i]];
            this.buttons[this.nextcp].push(rc);
            var pipes = new Pipes();
            var smoke = pipes.makeSmoke(open[i]);
            smoke.isSmoke = true;
            smoke.cp = this.cp;
            this.field[rc[0]][rc[1]] = smoke;
        }
    };

    this.isOutOfBounds = function(rc){
        var row = rc[0];
        var col = rc[1];

        if(row < 0){
            return true
        }
        if(row >= this.size){
            return true
        }
        if(col < 0){
            return true
        }
        if(col >= this.size + 2){
            return true
        }
        return false;
    };

    this.doesItConnect = function(pipe, row, col){
        var that = this;
        row = parseInt(row);
        col = parseInt(col);

        //get connections
        var connections = pipe.getConnect();
        var adds = [[row, col+1], [row+1, col], [row, col-1], [row-1, col]];

        //grab all connections
        for(var i=0; i< connections.length; i++){
        // connections.forEach(function(num) {
            var num = connections[i];
            //grab the row column for the connection
            var rc = adds[num];
            var row2 = rc[0];
            var col2 = rc[1];
            // that.buttons[that.cp].push(rc)
            //if the rc is out of bounds
            if(this.isOutOfBounds(rc) === true){
                console.log("Connection Goes Out Of Bounds");
                return false
            }

            try {
                console.log(that.field[row2][col2])
            }
            catch(err) {
                return false
            }

            //if there is something in the area
            console.log(that.field[row2][col2])

            if(that.field[row2][col2]) {
                //if it is not our smoke
                if (that.field[row2][col2].isSmoke && that.field[row2][col2].cp !== this.cp) {
                    console.log("Smoke Error");
                    console.log(that.field[row2][col2]);
                    console.log(that.cp)
                    return false;
                }

                //grab it
                var otherPipe = that.field[row2][col2];
                //get open locartions
                var otherOpen = otherPipe.getOpen();

                //grab the inverse of those
                var newOpen = [];
                otherOpen.forEach(function (o) {
                    newOpen.push((o + 2) % 4);
                });
                //check to see if one of them connects
                if (newOpen.indexOf(num) === -1) {
                    console.log(otherOpen, num);
                    console.log("Does not Connect");
                    console.log("Pipe it does not Connect to :", otherPipe);
                    return false
                } else {
                    if (that.field[row2][col2].isSmoke === false) {
                        if (otherPipe.isEnd === true) {
                            this.isDone[this.cp] = true;
                        }
                        pipe.removeOpen(num);
                        var good = true;
                    }
                }
            }
        }
        //check for other pipes
        for(var i=0; i< 4; i++) {
            // connections.forEach(function(num) {
            // var num = connections[i];
            if(connections.indexOf(i) == -1){
                //grab the row column for the connection
                var rc4 = adds[i];

                var row4 = rc4[0];
                var col4 = rc4[1];


                try {
                    console.log(that.field[row4][col4])
                }
                catch(err) {
                    continue
                }

                if(that.field[row4][col4] && that.field[row4][col4].isSmoke === false) {
                   var op = that.field[row4][col4].getOpen();
                   if(op.indexOf((i+2)%4) !== -1){
                       return false
                   }
                }
            }
        }

        if(good){
            return true
        }else{
            return false
        }

    };

    this.changeTurn = function(){
        console.log("change turn")
        that = this;
        var next = this.buttons[this.cp];
        var current = this.buttons[this.nextcp];

        next.forEach(function(b){
            var row = b[0];
            var column = b[1];
            if(that.field[row][column].isSmoke === true){
                var smoke = that.field[row][column];
                var image = smoke.display();
                var box = $($(that.sel.find('.row')[row]).find('.cell')[column]);
                box.html('<img class="leak" id="'+that.nextcp+'" src="'+image+'" alt="smoke">');
            }
        });

        current.forEach(function(b){
            var row = b[0];
            var column = b[1];
            if(that.field[row][column].isSmoke === true){
                var smoke = that.field[row][column];
                var image = smoke.display();
                var box = $($(that.sel.find('.row')[row]).find('.cell')[column]);
                box.html('<input type="submit" id="'+that.cp+'" class="leak" name="leak" value="'+row+','+column+'" style="background-image: url('+image+'">');
            }
        });

        $(this.sel.find(".leak")).click(function(b){
            b.preventDefault();
            var rowcol = $(this).val().split(",");
            var row = rowcol[0];
            var col = rowcol[1];
            var okay = that.addPipe(row, col);
            if(okay === true){
                // if(that.checkWin() === true){
                if(that.checkWin() === true){
                    that.changePictures();
                }
                that.changeCP();
                that.bottomRow.changeTurn();
                that.changeTurn();
            }
        });

    };
    
    this.changePictures = function () {

        var pipes = new Pipes();
        var startPipes = pipes.endPipes();
        var middle = this.size/2; //3
        var top = middle-3; // 3-3
        var top2 = middle-2; //2
        var bottom = middle+2;
        var bottom2 = middle+1;
        var end = this.size + 1;
        if(this.nextcp === 0){
            this.addStart(top, end, startPipes[2]);
            this.addStart(top2, end, startPipes[1]);
            this.addStart(top, 0, startPipes[0]);
        }else{
            //p2
            this.addStart(middle, end, startPipes[2]);
            this.addStart(bottom2, end, startPipes[1]);
            this.addStart(bottom, 0, startPipes[0]);
        }
    };

    this.displayInit = function(){
        var html = "";
        for(var i=0;i < this.size; i++) {
            html += '<div class="row">';
            for (var j = 0; j < this.size+2; j++) {
                html += '<div class="cell"></div>';
            }
            html += '</div>';
        }
        this.sel.html(html);
    }
}

function BottomRow(sel, grid){
    this.grid = grid;
    this.sel = $(sel);
    this.sel.html("<div class='pipes'></div><div class='buttons'></div>");
    this.pipes = $(this.sel.find('.pipes'));
    this.buttons = $(this.sel.find('.buttons'));
    this.currentPipes = [];
    this.nextPipes = [];
    var that = this;

    this.init = function(){
        var pipes = new Pipes();
        for(var i = 0; i < 5 ; i++){
            this.currentPipes.push(pipes.returnRandom());
        }
        for(var i = 0; i < 5 ; i++){
            this.nextPipes.push(pipes.returnRandom());
        }
        var html  = '<input type="submit" name="rotate" value="Rotate">'+
            '<input type="submit" name="discard" value="Discard">' +
            '<input type="submit" name="open_valve" value="Open Valve">' +
            '<input type="submit" name="clear" value="Give Up">';
        this.buttons.html(html);
        var buttons = $(this.sel.find('input'));
        buttons.click(function(event){
            event.preventDefault();
            that.handleButtonClick(this);
        });
    };

    this.popIt = function(index){
        var pipes = new Pipes();
        var pipe = this.currentPipes[index];
        this.currentPipes[index] = pipes.returnRandom();
        return pipe
    };

    this.copyIt = function(index){
        var pipe = this.currentPipes[index];
        return pipe
    };

    this.changeTurn = function(){
        cp = this.currentPipes;
        this.currentPipes = this.nextPipes;
        this.nextPipes = cp;

        for(var i = 0; i < this.currentPipes.length; i++){
            var image = this.currentPipes[i].display();
            $(this.pipes.find('img')[i]).attr("src", image);
        }
    };

    this.handleButtonClick = function(button){
        var type = button.value;
        if(type === 'Rotate'){
            var radioValue = $("input[name='pipe']:checked").val();
            if(radioValue){
                this.currentPipes[radioValue].rotate();
                var image = this.currentPipes[radioValue].display();
                $(this.pipes.find('img')[radioValue]).attr("src", image);
            }
        }else if(type === "Discard"){
            var radioValue = $("input[name='pipe']:checked").val();
            if(radioValue){
                var pipes = new Pipes();
                var newPipe = pipes.returnRandom();
                var image = newPipe.display();
                this.currentPipes[radioValue] = newPipe;
                $(this.pipes.find('img')[radioValue]).attr("src", image);
                this.grid.changeCP();
                this.changeTurn();
                this.grid.changeTurn();
            }
        }else if(type === "Open Valve"){
            if(this.grid.checkWin() === true) {
                this.grid.form.html("<div class='title'><h1>" + this.grid.players[this.grid.cp] + " Wins!</h1><input type='submit' value='New Game'></div>")
            }
        }else if(type === "Give Up"){
            this.grid.form.html("<div class='title'><h1>" + this.grid.players[this.grid.nextcp] + " Wins!</h1><input type='submit' value='New Game'></div>")
        }

    };

    this.display = function(){
        var html = "";
        for(var i = 0; i < 5 ; i++){
            var image = this.currentPipes[i].display();
            html += '<img src="'+image+'" alt="'+image+'"><input type="radio" value="'+i+'" name="pipe">';
        }
        this.pipes.html(html);
    };
}


function Pipes(){
    this.returnRandom = function(){
        var randomInt = Math.floor(Math.random()*4);
        var pipe;
        if(randomInt === 0){
            pipe = this.make_cap();
        }else if(randomInt ===1){
            pipe = this.make_ninety();
        }else if(randomInt ===2){
            pipe = this.make_straight();
        }else{
            pipe = this.make_tee()
        }
        return pipe;
    };

    this.startPipes = function(){
        var pipe1 = new Pipe(["valve-closed.png"], [[0]],[[0]], 0);
        var pipe2 = new Pipe(["gauge-0.png"], [[2]],[[2]], 0);
        var pipe3 = new Pipe(["gauge-top-0.png"], [[-1]],[[-1]], 0);
        return [pipe1, pipe2, pipe3]
    };

    this.endPipes = function(){
        var pipe1 = new Pipe(["valve-open.png"], [[0]],[[0]], 0);
        var pipe2 = new Pipe(["gauge-190.png"], [[2]],[[2]], 0);
        var pipe3 = new Pipe(["gauge-top-190.png"], [[-1]],[[-1]], 0);
        return [pipe1, pipe2, pipe3]
    };

    this.make_cap = function(){
        var file_names = ["cap-e.png", "cap-s.png", "cap-w.png", "cap-n.png"];
        var open_at = [[-1],[-1],[-1],[-1]];
        var connects_to = [[0],[1],[2],[3]];
        var rotation = Math.floor(Math.random()*file_names.length);
        return new Pipe(file_names,open_at,connects_to,rotation);
    };

    this.make_ninety = function(){
        var file_names = ["ninety-es.png", "ninety-sw.png", "ninety-wn.png", "ninety-ne.png"];
        var open_at = [[0, 1],[1, 2],[2, 3], [3, 0]];
        var connects_to = [[0, 1],[1, 2],[2, 3], [3, 0]];
        var rotation = Math.floor(Math.random()*file_names.length);
        return new Pipe(file_names,open_at,connects_to,rotation);
    };
    this.make_straight = function(){
        var file_names = ["straight-h.png", "straight-v.png"];
        var open_at = [[0,2], [1, 3]];
        var connects_to = [[0,2],[1, 3]];
        var rotation = Math.floor(Math.random()*file_names.length);
        return new Pipe(file_names,open_at,connects_to,rotation);
    };

    this.make_tee = function(){
        var file_names = ["tee-esw.png", "tee-swn.png", "tee-wne.png", "tee-nes.png"];
        var open_at = [[0, 1, 2],[1, 2, 3],[2, 3, 0], [1, 0, 3]];
        var connects_to = [[0, 1, 2],[1, 2, 3],[2, 3, 0], [1, 0, 3]];
        var rotation = Math.floor(Math.random()*file_names.length);
        return new Pipe(file_names,open_at,connects_to,rotation);
    };

    this.makeSmoke = function(rotation){
        var files = ["leak-w.png", "leak-n.png", "leak-e.png", "leak-s.png"];
        var opens = [[0,1,2,3],[0,1,2,3], [0,1,2,3], [0,1,2,3]];
        var connects = [[0],[1],[2],[3]];
        return new Pipe(files,opens,connects,rotation);
    }
}

function Pipe(filename, open, connect, rotation){
    this.isSmoke = false;
    this.filenames = filename;
    this.open = open;
    this.connect = connect;
    this.rotation = rotation;
    this.size = filename.length;

    this.rotate = function(){
        this.rotation = (this.rotation+1)%this.size;
    };

    this.display = function(){
        return 'images/' + this.filenames[this.rotation];
    };

    this.getOpen = function(){
        return this.open[this.rotation]
    };

    this.getConnect = function(){
        return this.connect[this.rotation]
    };

    this.removeOpen = function(num){
      var index = this.open[this.rotation].indexOf(num);
      this.open[this.rotation].splice(index, 1)
    };

}

