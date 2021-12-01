<?php
require_once('../config/koneksi.php');


    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=inbox.xls");

	$query = "SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b order by ReceivingDateTime";
    $hasil = mysqli_query($mysqli, $query);
    $j_data = mysqli_num_rows($hasil);
    echo "<table>";
    echo "<tr><b><td>No</td><td>TANGGAL</td><td>NO HP PENGIRIM</td><td>NAMA PENGIRIM</td><td>ISI PESAN</td></tr>";

        $no = 1;
        while ($data = mysqli_fetch_array($hasil)) {
            echo "<tr>
			<td>$no</td>
			<td>" . $data['ReceivingDateTime'] . "</td>
			<td>'" . $data['SenderNumber'] . "</td>
			<td>" . $data['nmpengirim'] . "</td>
			<td>" . $data['TextDecoded'] . "</td>
			";
            $no++;
        }

    
    echo "</table>";



	
?>