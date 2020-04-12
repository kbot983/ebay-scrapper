<?php

include 'conn.php';


$stmt = $conn->prepare("SELECT email, prod_list FROM user_info");
// $id = $_GET["id"];
// $stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

print("<html>");
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {

	}
} else {

}
print("</html>");
$conn->close();

?>