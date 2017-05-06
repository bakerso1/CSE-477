/*! DO NOT EDIT ajaxnoir 2017-04-28 */
function Login(sel) {

    var form = $(sel);
    form.submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "post/login.php",
            data: form.serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Login was successful
                    window.location.assign("./");

                } else {
                    // Login failed, a message is in json.message
                    $(sel + " .message").html("<p>" + json.message + "</p>");

                }
                //console.log(json);
            },
            error: function(xhr, status, error) {
                // An error!
                $(sel + " .message").html("<p>Error: " + error + "</p>");
                console.log(error);
            }
        });

        console.log("Submitted");
    });
}
function MovieInfo(sel, title, year) {
    console.log("MovieInfo: " + title + "/" + year);


    var movie = $(sel);
    var that = this;

    //title = "Godfather";
    //year = "1972";

    $.ajax({
        url: "https://api.themoviedb.org/3/search/movie",
        data: {api_key: "6376507a340c6770c0cf517e8bfed1a8", query: title, year: year},
        method: "GET",
        dataType: "text",
        success: function(data) {
            var json = parse_json(data);
            if(json.total_results == 0){
                $(".paper").html("<p>No information available</p>");
            }else{
                that.successPrint(sel, json.results[0]);
                console.log(json.results[0]);
            }
        },
        error: function(xhr, status, error) {
            // An error!
            $(".paper").html("<p>Unable to connect</p>");
        }
    });


}


MovieInfo.prototype.successPrint = function(sel, movie){
    console.log(movie);
    var html = "<ul><li id='info'><a href='#'><img src='images/info.png'></a><div class='show'>";
    html += "<h1>Title: " + movie['title'] + "</h1>";
    html += "<p>Release Date: " + movie['release_date'] + "</p>";
    html += "<p>Vote Average: " + movie['vote_average'] + "</p>";
    html += "<p>Vote Count: " + movie['vote_count'] + "</p>";
    html += "</div></li>";
    html += "<li id='plot'><a href='#'><img src='images/plot.png'></a><div>";
    html += "<p>" + movie['overview'] + "</p>";
    html += "</div></li>";
    html += "<li id='poster'><a href='#'><img src='images/poster.png'></a>";
    html += "<div><p class='poster'><img id='poster' src=''></p>";
    html += "</div></li></ul>";

    $(sel).html(html);
    $("img#poster").attr('src', 'http://image.tmdb.org/t/p/w500/' + movie['poster_path']);
    $( document ).ready(function() {
        $( "li#info > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#plot > div").fadeOut(1000);
            $("li#poster > div").fadeOut(1000);
            $("li#info > div").fadeIn(1000);
        });
        $( "li#poster > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#info > div").fadeOut(1000);
            $("li#plot > div").fadeOut(1000);
            $("li#poster > div").fadeIn(1000);
        });
        $( "li#plot > a" ).click(function() {
            $("ul > li > a > img").css("opacity", 0.3);
            $("li#info > div").fadeOut(1000);
            $("li#poster > div").fadeOut(1000);
            $("li#plot > div").fadeIn(1000);
        });
    });
};
function parse_json(json) {
    try {
        var data = $.parseJSON(json);
    } catch(err) {
        throw "JSON parse error: " + json;
    }

    return data;
}
function Stars(sel) {

    console.log("Stars constructor");
    that = this;
    var table = $(sel + " table");  // The table tag

    // Loop over the table rows
    var rows = table.find("tr");    // All of the table rows
    for(var r=1; r<rows.length; r++) {
        // Get a row
        var row = $(rows.get(r));

        // Determine the row ID
        var id = row.find('input[name="id"]').val();

        // Find and loop over the stars, installing a listener for each
        var stars = row.find("img");
        for(var s=0; s<stars.length; s++) {
            var star = $(stars.get(s));

            // We are at a star
            this.installListener(row, star, id, s+1);
        }

    }
}


Stars.prototype.updateTable = function(table) {
    $('table').html(table);
};


Stars.prototype.installListener = function(row, star, id, rating) {
    var that = this;

    star.click(function() {

        console.log("Click on " + id + " rating: " + rating);

        $.ajax({
            url: "post/stars.php",
            data: {id: id, rating: rating},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    // Successfully updated
                    that.update(row, rating);
                    that.updateTable(json.table);
                    that.message("<p>Successfully updated</p>");

                } else {
                    // Update failed
                    that.message("<p>Update failed</p>");


                }
            },
            error: function(xhr, status, error) {
                // Error
                that.message("<p>Error: " + error + "</p>");

            }
        });


    });
}

Stars.prototype.update = function(row, rating) {

    // Loop over the stars, setting the correct image
    var stars = row.find("img");
    for(var s=0; s<stars.length; s++) {
        var star = $(stars.get(s));

        if(s < rating) {
            star.attr("src", "images/star-green.png")
        } else {
            star.attr("src", "images/star-gray.png");
        }
    }

    var num = row.find("span.num");
    num.text("" + rating + "/10");
}


Stars.prototype.message = function(message) {
    // do something...
    $('.message').html(message).show().delay(2000).fadeIn(1000).fadeOut(1000);
}