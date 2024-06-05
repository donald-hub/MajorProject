<?php
    require "connect.php";


try {

echo '<div id="printSection" style="padding-bottom: 0px;"><div class="center">
        <h3 style="text-align: center;" class="headers bold">Course Code:&ThickSpace;CS413</h3>
        <h3 style="text-align: center;" class="headers bold">Course Title:&ThickSpace; Database Management System</h3>
        <h3 style="text-align: center;" class="headers bold"> CO-PO Mapping Table</h3>
    </div>';
echo '<div class="container" style="margin-top: 0px;">
        <table style="margin-top: 0px;" class="table table-bordered" border = "1">
            <thead>
                <tr>
                <th></th>';
                $subquery = "SELECT program_ob_no from project_data.programme_ob";
                $stmt2 = $conn->prepare($subquery); 
                $stmt2->execute();
                $subresults = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;
                foreach($subresults as $program_ob){
                    $count++;
                    echo '<th>'.$program_ob["program_ob_no"].'</th>';
                }


    echo '</tr>
            </thead>
            <tbody>';
$array2d = array(
    array('CO1','2','1','1','3','-','1','-'),
    array('CO2','2','1','2','-','3','-','3'),
    array('CO3','1','2','1','3','2','3','2'),
    array('CO4','-','-','2','1','-','1','-'),
    array('CO5','2','2','-','3','-','1','-'),
    array('Wt. Avg','1.75','1.5','1.5','2.5','2.5','1.5','2.5')
);
// Loop through the results and output them
// foreach ($results as $row) {
//     echo "<tr>
//             <td>{$row['course_ob_no']}</td>";
//             for($i = 0; $i < $count; $i++){
//                 echo "<td>$i+1</td>";
//             }
            
//             echo "</tr>";
// }
foreach ($array2d as $row) {
    echo "<tr>";
    foreach ($row as $element) {
        echo "<td>".$element . "</td> ";
    }
    echo "</tr>";
}
// echo "<tr>
//         <td>Wt. Average</td>";
//         for($i = 0; $i < $count; $i++){
//             echo "<td></td>";
//         }
//     echo "</tr>";

echo '        </tbody>
        </table>
        <div class="container">
        <div class="col-md-8"></div>
        <div class="col-md-4">
        <table class="table table-bordered"><tr><td>Overall Mapping of Course</td><td>1.96</td></tr></table>
        </div>
        </div>
    </div>
    </div>';
    

} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}






echo "<h3 style='text-align: center'><caption>CO Attainment</caption></h3>";
echo '<div class="row"><div class="col-md-3"></div><div class="col-md-6">
<table class="table table-bordered">
<thead>
<th>CO Number</th>
<th>CO Attainment</th>
</thead>
<tbody>
<tr>
<td style="font-weight: bolder";>CO1</td>
<td>1.96</td>
</tr>
<tr>
<td style="font-weight: bolder";>CO2</td>
<td>2.4</td></tr>
<tr>
<td style="font-weight: bolder";>CO3</td>
<td>2.0</td></tr>
<tr>
<td style="font-weight: bolder";>CO4</td>
<td>1.5</td></tr>
<tr>
<td style="font-weight: bolder";>CO5</td>
<td>1.8</td></tr>
</tbody>
</table>
</div><div class="col-md-3"></div></div>';







try {

    echo '<div id="printSection" style="padding-bottom: 0px;"><div class="center">
            <h3 style="text-align: center;" class="headers bold">CO-PO Attainment Table</h3>
        </div>';
    echo '<div class="container" style="margin-top: 0px;">
            <table style="margin-top: 0px;" class="table table-bordered" border = "1">
                <thead>
                    <tr>
                    <th></th>';
                    $subquery = "SELECT program_ob_no from project_data.programme_ob";
                    $stmt2 = $conn->prepare($subquery); 
                    $stmt2->execute();
                    $subresults = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    $count = 0;
                    foreach($subresults as $program_ob){
                        $count++;
                        echo '<th>'.$program_ob["program_ob_no"].'</th>';
                    }
    
    
        echo '</tr>
                </thead>
                <tbody>';
    $array2d = array(
        array('CO1','2','1','1','3','-','1','-'),
        array('CO2','2','1','2','-','3','-','3'),
        array('CO3','1','2','1','3','2','3','2'),
        array('CO4','-','-','2','1','-','1','-'),
        array('CO5','2','2','-','3','-','1','-'),
        array('Wt. Avg','2.04','1.99','1.96','1.87','2.24','1.87','2.14')
    );
    // Loop through the results and output them
    // foreach ($results as $row) {
    //     echo "<tr>
    //             <td>{$row['course_ob_no']}</td>";
    //             for($i = 0; $i < $count; $i++){
    //                 echo "<td>$i+1</td>";
    //             }
                
    //             echo "</tr>";
    // }
    foreach ($array2d as $row) {
        echo "<tr>";
        foreach ($row as $element) {
            echo "<td>".$element . "</td> ";
        }
        echo "</tr>";
    }
    // echo "<tr>
    //         <td>Wt. Average</td>";
    //         for($i = 0; $i < $count; $i++){
    //             echo "<td></td>";
    //         }
    //     echo "</tr>";
    
    echo '        </tbody>
            </table>
            <div class="container">
            <div class="col-md-8"></div>
            <div class="col-md-4">
            <table class="table table-bordered"><tr><td>Overall PO Attainment</td><td>2.01</td></tr></table>
            </div>
            </div>
        </div>
        </div>';
        
    
    } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    

// }
?>