
<?php
//index.php
$connect = mysqli_connect("localhost", "root", "", "testing");
function make_query($connect)
{
 $query = "SELECT * FROM banner ORDER BY banner_id ASC";
 $result = mysqli_query($connect, $query);
 return $result;
}

function make_slide_indicators($connect)
{
 $output = ''; 
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides($connect)
{
 $output = '';
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img src="banner/'.$row["banner_image"].'" alt="'.$row["banner_title"].'" />
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>

<!DOCTYPE html>
<html>
 <head>
    <title>SLIDER PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital@1&display=swap" rel="stylesheet">
    <style>
      .top-right {
        position: absolute;
        top: 8px;
        right: 16px;
        font-size: 18px;
        width: 200px;
      }
      .carousel-inner {
        border: 10px solid blue; /* Añade un borde blanco de 10px */
      }
      .top-left {
        position: absolute;
        top: 30px; /* Cambia bottom por top */
        left: 16px;
        font-size: 22px;
        width: 200px;
        font-family: 'Courier Prime', monospace;
      }
      h2 {
        font-family: 'Courier Prime', monospace;
      }
      h3 {
        font-family: 'Courier Prime', monospace;
        color: blue;
      }
    </style>
 </head>
 <body>
  <img src="ugmaLogo2.png" alt="Logo" class="top-right">
  <br />
  <div class="top-left">
    <p>Integrantes:</p>
    <p>Jose Lopez</p>
    <p>Hector Millan</p>
    <p>Johiner Almeida</p>
    <p>Luis Candiales</p>
  </div>
  <div class="container">
   <h2 align="center">Slider Informativo de PHP</h2>
   <h3 align="center">Seminario de Software</h3>
   <br />
   <div id="dynamic_slide_show" class="carousel slide">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators($connect); ?>
    </ol>

    <div class="carousel-inner">
     <?php echo make_slides($connect); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
 </body>
</html>

<script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: false
        });
    });
</script>

