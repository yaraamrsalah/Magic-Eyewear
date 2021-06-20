<?php   $this->view("includes/header",$data);?> 
<?php 
 $host = "localhost";  
 $db_user = "root";  
 $db_pass = "";  
 $dbname = "magic_eyewear";  

 $connect = new PDO("mysql:host=$host; dbname=$dbname", $db_user, $db_pass); 

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    
    <link href="<?=ASSETS?>css/ProductListing.css" rel="stylesheet">

</head>

<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
  
    <!-- Page Content -->
    <div class="container">
        <br>
        <br>
        <h1 class="text-center">SHOP</h1>
        <br>
        <br>

<div class="bg-white rounded d-flex align-items-center justify-content-between" id="header">
            <button class="btn btn-hide text-uppercase" type="button" data-toggle="collapse" data-target="#filterbar" aria-expanded="false" aria-controls="filterbar" id="filter-btn" onclick="showandhidefilters()" style="background-color: #13293d; color: white;"> 
                    <span class="fas fa-angle-left"></span> 
                    <span id="togglefilters">Hide filters</span> 
            </button>
            <nav class="navbar navbar-expand-lg navbar-light pl-lg-0 pl-auto"> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynav" aria-controls="mynav" aria-expanded="false" aria-label="Toggle navigation"  id="icon"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="mynav">
                    <ul class="navbar-nav d-lg-flex align-items-lg-center">
                        <li class="nav-item active">
                         <select name="sort" id="sort">
                            <option value=""  selected>Sort by price</option>
                            <option value="lowhigh">lowest to highest</option>
                            <option value="highlow">highest to lowest </option>
                         </select> 
                        </li>
                    </ul>
            </div>
            </nav>
        
</div>
<script type="text/javascript">
    function showandhidefilters() {
$('#filterbar').collapse(true);
var x = document.getElementById("filtersbar");
  if (x.style.display === "none") {
    x.style.display = "block";
    document.getElementById("togglefilters").innerhtml = "hide filters"
  } else {
    x.style.display = "none";
    document.getElementById("togglefilters").innerText= "show filters"
  }
}

</script>

        <div class="row">
            <div class="col-md-3" id="filtersbar">
                <div class="list-group">
                    <h3>Price</h3>
                    <input type="hidden" id="min_price_hide" value="0" />
                    <input type="hidden" id="max_price_hide" value="2000" />
                    <p id="price_show">10 EGP - 2000 EGP</p>
                    <div id="price_range"></div>
                </div>

                <div class="list-group">
                    <h3>Gender</h3>
                    <?php
                    $query = "
                    SELECT DISTINCT(GenderType) FROM gender ORDER BY GenderID ASC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="filter_all gender" value="<?php echo $row['GenderType']; ?>"  > <?php echo $row['GenderType']; ?> </label>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="list-group">
                    <h3>Brand</h3>
                    <?php
                    $query = "SELECT DISTINCT(BrandName) FROM brand ORDER BY BrandID DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                            <div class="list-group-item checkbox">
                                <label>
                                    <input type="checkbox" class="filter_all brand" value="<?php echo $row['BrandName']; ?>">
                                    <?php echo $row['BrandName']; ?>
                                </label>
                            </div>
                            <?php
                    }
                    ?>
                </div>

                <div class="list-group">
                    <h3>Color</h3>
                    <?php
                    $query = "SELECT DISTINCT(ColorName) FROM color ORDER BY ColorID DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                            <div class="list-group-item checkbox">
                                <label>
                                    <input type="checkbox" class="filter_all color" value="<?php echo $row['ColorName']; ?>">
                                    <?php echo $row['ColorName']; ?>
                                </label>
                            </div>
                            <?php
                    }
                    ?>
                </div>

            </div>

            <div class="col-md-9">

                <div class="row filter_data">

                </div>

            </div>
        </div>

    </div>

<<<<<<< HEAD
   <!-- <script src="js/jquery-1.11.1.min.js"></script> -->>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <!--<script src="js/bootstrap.min.js"></script>-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"  ></script>
    <!--<script src="js/jquery-ui.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
=======
>>>>>>> 9fd488e6dfd731dcf137d5519f9e6b72a74797b0

    <script>
        $(document).ready(function() {

            filter_data();

            function filter_data() {
                $('.filter_data');
                var action = 'fetch_data';
                var minimum_price = $('#min_price_hide').val();
                var maximum_price = $('#max_price_hide').val();
                var brand = get_filter('brand');
                var color = get_filter('color');
                var gender = get_filter('gender');
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        color: color,
                        gender: gender
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.filter_all').click(function() {
                filter_data();
            });

            $('#price_range').slider({
                range: true,
                min: 10,
                max: 300,
                values: [10, 300],
                step: 10,
                stop: function(event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#min_price_hide').val(ui.values[0]);
                    $('#max_price_hide').val(ui.values[1]);
                    filter_data();
                }
            });

        });
    </script>
<?php   $this->view("includes/footer",$data);?> 

</body>

</html>