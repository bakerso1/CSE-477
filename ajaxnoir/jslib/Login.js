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