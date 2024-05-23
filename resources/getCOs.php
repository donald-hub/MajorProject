<head>
<!--including boostrap files below-->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
<?php

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== ""){
    require "connect.php";
    $query = "SELECT course_ob_no,description FROM course_ob where course_id = '$q';";
      $stmt = $conn->prepare($query); 
      // EXECUTING THE QUERY 
      $stmt->execute(); 
      $r = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
      // FETCHING DATA FROM DATABASE 
      $result = $stmt->fetchAll(); 

    $html = "<table class=\"table table-bordered\">
              <tr>
                <th class=\"col-md-1\">CO</th>
                <th class=\"col-md-10\">Desciption</th>
                <th class=\"col-md-1\">Questions</th>
              </tr>"; 
    foreach ($result as $row)  
    {
    $html .= "<tr><td>".$row['course_ob_no']."</td>";
    $html .= "<td>".$row['description']."</td>";
    $html .= "<td><input class='form-control' type='text' > </input></td></tr>";
  }
  $html .= "</table>";
  echo $html;
}
?>
</body>