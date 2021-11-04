
<html>


</html>
<?php

session_start();

$title = "Főoldal";
include 'htmlheader.inc.php';

require 'db.inc.php';
require 'model/Ulesrend.php';
$tanulo = new Ulesrend;
require 'functions.inc.php';

include 'htmlheader.inc.php';
?>

<body>
        

<?php

$page ='index';



if(isset($_REQUEST['page'])){


if(file_exists('controller/'.$_REQUEST['page'].'.php')){


$page = $_REQUEST['page'];

}


}
include 'controller/'.$page.' .php';




?>

</body>








?>
