<html>
    <head>
        <title>title</title>
        <script>
            document.onreadystatechange = function () {
                var state = document.readyState
                if (state == 'interactive') {
                    document.getElementById('contents').style.visibility = "hidden";
                } else if (state == 'complete') {
                    setTimeout(function () {
                        document.getElementById('interactive');
                        document.getElementById('load').style.visibility = "hidden";
                        document.getElementById('contents').style.visibility = "visible";
                    }, 1000);
                }
            }
        </script>
        <style>
            #load{
                width:100%;
                height:100%;
                position:fixed;
                z-index:9999;
                background:url("https://www.creditmutuel.fr/cmne/fr/banques/webservices/nswr/images/loading.gif") no-repeat center center rgba(0,0,0,0.25)
            }
        </style>
    </head>
    <body>

        <div id="load"></div>
        <div id="contents">
            jlkjjlkjlkjlkjlklk
        </div>
    </body>
</html>


