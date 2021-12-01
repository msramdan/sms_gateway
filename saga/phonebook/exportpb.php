<?php
require_once('../config/koneksi.php');

if (isset($_POST['submit'])) {
	$group=$_POST['gp'];
	
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=phonebook.xls");

	$query = "select * from pbk where GroupID='$group'";
    $hasil = mysqli_query($mysqli, $query);
    $j_data = mysqli_num_rows($hasil);
    echo "<table>";
    echo "<tr><b><td>No</td><td>Nama</td><td>NO HP</td></tr>";

        $no = 1;
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<tr><td>$no</td><td>" . $data['Name'] . "</td><td>'" . $data['Number'] . "</td>";
            $no++;
        }

    
    echo "</table>";

}

	
?>