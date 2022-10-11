<?php		
	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	$conn =new mysqli('localhost', 'root', '' , 'propose');

	$sql = $conn->prepare("SELECT job_title FROM jobs_post WHERE job_title LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["job_title"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();
?>