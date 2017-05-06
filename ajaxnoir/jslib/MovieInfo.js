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