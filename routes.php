<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
<body>
<div class="container">
<?php

$jsonString = file_get_contents('routes.json');
$data = json_decode($jsonString, true);
$status = ""; $remarks = ""; $asof = "";
$to = $_POST["to"];
$from = $_POST["from"];
$i='0';
foreach ($data as $route) {
    if((($to == $route['to']) && ($from == $route['from'])) || (($to == $route['from']) && ($from == $route['to'])))
    {
        $i='1';
        $status = $route['status'];
        $asof = $route['asof'];
        $remarks = $route['remarks'];
    }
}
if($i=='0')
{
    $status = "Unknown";
    $asof = "Unknown";
    $remarks = "Unknown";
}
$newJsonString = json_encode($data);
file_put_contents('routes.json', $newJsonString);

?>

<h2><?php echo $to . " - " . $from. " route" ?></h2>
<br>
<h4>Status: <b><?php echo $status; ?></b></h4>
<h4>As of: <b><?php echo $asof; ?></b></h4>
<h4>Remarks: <b><?php echo $remarks; ?></b></h4>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update status of a bus route / Add a bus route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-info">Check another route</button></a>
</div>
</body>
</html>
