<?php
if (!empty($_GET["department_id"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "intranet";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $cat = $_GET["category_id"];
    $sql = "SELECT id,full_name FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        ?>
        <select name="data[EmployeeManagement][employer_id]" class="span9 uniform">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <option value = "<?php echo $row["id"]; ?>"><?php echo $row["full_name"]; ?></option>
                <?php
                // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            }
            ?>
        </select>
        <?php
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>
