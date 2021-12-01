<?php

function ExportExcel($table)
	{
		$filename = "uploads/".strtotime("now").'.csv';

		$sql = mysqli_query($mysqli,"SELECT * FROM $table");

		$num_rows = mysqli_num_rows($sql);
		if($num_rows >= 1)
		{
			$row = mysqli_fetch_assoc($sql);
			$fp = fopen($filename, "w");
			$seperator = "";
			$comma = "";

			foreach ($row as $name => $value)
				{
					$seperator .= $comma . '' .str_replace('', '""', $name);
					$comma = ",";
				}

			$seperator .= "\n";
			fputs($fp, $seperator);
	
			mysqli_data_seek($sql, 0);
			while($row = mysqli_fetch_assoc($sql))
				{
					$seperator = "";
					$comma = "";

					foreach ($row as $name => $value) 
						{
							$seperator .= $comma . '' .str_replace('', '""', $value);
							$comma = ",";
						}

					$seperator .= "\n";
					fputs($fp, $seperator);
				}
	
			fclose($fp);
			echo "Your file is ready. You can download it from <a href='$filename'>here!</a>";
		}
		else
		{
			echo "There is no record in your Database";
		}


	}
?>