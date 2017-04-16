<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>賽事賠率</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>
    <body>
        <h1>賽事賠率</h1>
        <div id="odd">

        </div>

        <script>
            setInterval(function () {
                $.ajax({
                    url: '/api',
                    success: function(res) {
                        $('#odd').html(res);
                    },
                    error: function (err) {
                        console.warn(err);
                    }
                })
            }, 500);
        </script>
    </body>
</html>
