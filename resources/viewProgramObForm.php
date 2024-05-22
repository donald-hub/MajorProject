<?php
require "connect.php";
if(isset($_POST['program_id_btn'])){
    $program_id = $_POST['program_id'];

try {

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT programme_ob.program_ob_no, programme_ob.program_ob_description, programme.program_id, programme.program_name, programme.dept_id
                           FROM programme_ob
                           JOIN programme ON programme_ob.program_id = programme.program_id
                           WHERE programme_ob.program_id = '$program_id'");
    // Execute the statement
    $stmt->execute();

    // Fetch all the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="center">
            <h3 class="bold">Programme Code:&ThickSpace;'.$program_id.'</h3>
        </div>
        <div class="center">
            <h3 class="bold">Programme Name:&ThickSpace;'.$results[0]['program_name'].'</h3>
        </div>
        <div class="center">
            <h3 class="bold">Offering Department:&ThickSpace;'.$results[0]['dept_id'].'</h3>
        </div>';
    echo '<div class="container">
            <table class="table table-bordered" border = "1">
                <thead>
                    <tr>
                    <th>PO\'s</th>
                    <th>Statements</th>
                    <th>Options</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the results and output them
    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['program_ob_no']}</td>
                <td>{$row['program_ob_description']}</td>
                <td><a role='button'>Edit</a></td>
              </tr>";
    }

    echo '        </tbody>
            </table>
            <button class="btn btn-info">Add CO</button>
        </div>';
        

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
}
?>