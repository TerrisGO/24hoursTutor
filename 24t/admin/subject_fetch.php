<?php

//fetch.php

require_once('db.php');

$query = "SELECT * FROM `subject` Order by Categories";
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '<div class="table-responsive">
<table class="table table-striped table-bordered">
	<tr>
		<th>Subject Name</th>
		<th>Category</th>
		<th>Edit</th>
		<th>Delete</th>
    </tr>
    </tr>
    </thead>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
        $output .= '
		<tr>
			<td>'.$row["subject_name"].'</td>
			<td>'.$row["categories"].'</td>
			<td>
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["subject_id"].'">Edit</button>
			</td>
			<td>
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["subject_id"].'">Delete</button>
			</td>

 ';  

	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</div>                                        </tbody>
</table>';
echo $output;
?>