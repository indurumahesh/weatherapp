<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<title>Weather App</title>
</head>
<body>

    <h1 class="text-center p-3">Weather App</h1>

    <?php include("config.php"); ?>

    <div class="row">
        <?php for($x=1;$x<10;$x++) { ?>
        <div class="col-sm-4 border p-3 box-panel" id="panel<?= $x ?>" data-pid="<?= $x ?>" >
            <div class="form-group text-center align-middle" id="t<?= $x ?>" style="display: none">
                <label for="exampleInputEmail1">City Name</label>
                <input type="email" id="cityname<?= $x ?>" aria-describedby="cityname" placeholder="Enter city name">
                <button class="btn btn-primary find-btn" id="f_btn<?= $x ?>" data-bid="<?= $x ?>">Find</button>
                <h1 id="ht<?= $x ?>"></h1>
                <snap id="imgspn<?= $x ?>"></snap>

                 <button class="btn btn-primary edit-btn" id="e_btn<?= $x ?>" data-ebid="<?= $x ?>" style="display: none">Edit</button>

                
              </div>
        </div>
            <?php } ?>
    </div>


    <script type="text/javascript">
        $(".box-panel").on("click",function()
        {
            var pid = $(this).attr('data-pid');

            $("#t"+pid).show();
        });


        $(".find-btn").on("click",function()
        {
            var bid = $(this).attr('data-bid');
            var cname = $("#cityname"+bid).val();

            $.ajax({
                url: "http://api.openweathermap.org/data/2.5/weather?q="+cname+"&appid=<?= KEY ?>&units=metric",
                type: 'GET',
                dataType: 'json', 
                statusCode: {
                    404: function() {
                      $("#ht"+bid).html("Enter valid city name");
                    }
                },
                success: function(res) {
                    $("#ht"+bid).html("Temp - "+res.main.temp+" &#176c");
                    $("#e_btn"+bid).show();
                    $("#f_btn"+bid).hide();
                    $('#imgspn'+bid).html("<span style='color:green'>"+res.weather[0].description+"</span><img src='http://openweathermap.org/img/wn/"+res.weather[0].icon+"@2x.png'>");       
                }
            });
            
        });


        $(".edit-btn").on("click",function()
        {
            var ebid = $(this).attr('data-ebid');

            $("#e_btn"+ebid).hide();
            $("#f_btn"+ebid).show();
            $("#cityname"+ebid).val("");
            $("#ht"+ebid).text("");
            $('#imgspn'+ebid).html("");

        });

    </script>
   

</body>
</html>
