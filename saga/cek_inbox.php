<?php
//SourceCode by AndezNET.com
include "config/koneksi.php" 

?>

<a data-toggle="dropdown" class="dropdown-toggle" href="#">
    <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">
                                <?php

                                $querceksetting=mysqli_query($mysqli,"select * from tbl_setting order by idset DESC limit 1");
                                $rowceksetting=mysqli_fetch_array($querceksetting);

                                $quercekautoreply=mysqli_query($mysqli,"select * from tbl_autoreply order by id DESC limit 1");
                                $rowcekautoreply=mysqli_fetch_array($quercekautoreply);
                                $pesanautoreply=$rowcekautoreply['pesan'];

                                $set_autoreply=$rowceksetting['set_autoreply'];
                                $set_ultah=$rowceksetting['set_ultah'];
                                $pesan_ultah=$rowceksetting['set_pesan_ultah'];
                                $set_autorespon=$rowceksetting['set_autorespon'];

                                if($set_autoreply=="1"){
                                  $querycekinbox = "SELECT * FROM inbox WHERE Processed = 'false'";
                                  $hasilcekinbox = mysqli_query($mysqli,$querycekinbox);
                                  while($rowcekinbox=mysqli_fetch_array($hasilcekinbox)){
                                     $sqlinsertauto = mysqli_query($mysqli,"INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$rowcekinbox[SenderNumber]','$pesanautoreply', 'Gammu')");
                                  }
                                  $query4 = "UPDATE inbox SET Processed = 'true'";
                                  $hasil4 = mysqli_query($mysqli,$query4);    
                                }
                                // echo $set_ultah;
                                if($set_ultah=="1"){

                                 $hari=date("d");
                                 $bulan=date("m");
                                 $tahun=date("Y");
                                 // echo $hari;
                                 //Untuk cek Tanggal Ultah
                                 $quercekultah=mysqli_query($mysqli,"SELECT * FROM pbk where month(tgl_lahir)='$bulan' and day(tgl_lahir)='$hari' ");
                                  $cekultahsdsad=mysqli_num_rows($quercekultah);
                                   
                                    while ($rowsultah=mysqli_fetch_array($quercekultah)) {
                                        $nohpultah=$rowsultah['Number'];
                                        $namapeg=$rowsultah['Name'];
                                        $gabungpesan=$namapeg.', '.$pesan_ultah;
                                        
                                        $quercektblultah=mysqli_query($mysqli,"SELECT * FROM tbl_sms_ultah where no_hp='$nohpultah' and tahun='$tahun' ");
                                        $jmlcektblultah=mysqli_num_rows($quercektblultah);
                                        if($jmlcektblultah==0){
                                            $sqlucapanultah = mysqli_query($mysqli,"INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohpultah','$gabungpesan', 'Gammu')");
                                            $querytotblultah=mysqli_query($mysqli,"INSERT INTO tbl_sms_ultah (no_hp,nama,ucapan,tahun,tanggal) values ('$nohpultah','$namapeg','$gabungpesan','$tahun',NOW()) ");
                                        }
                                        
                                    }
                                }


                                if($set_autorespon=="1"){
                                  $querycekinboxlagi = "SELECT * FROM inbox WHERE Processed = 'false'";
                                  $hasilrowcekinbox = mysqli_query($mysqli,$querycekinboxlagi);
                                  while ($data = mysqli_fetch_array($hasilrowcekinbox))
                                  {
                                    
                                    $id2 = $data['ID'];
                                   

                                    $noPengirim = $data['SenderNumber'];
                                    
                                    $msg = strtoupper($data['TextDecoded']);
                                    $pecah = explode(" ", $msg);
                                    
                                     $query1 = "SELECT keyword1,idforward,no_forward FROM tbl_autorespon WHERE keyword1='$pecah[0]'";
                                       $hasil1 = mysqli_query($mysqli,$query1);
                                       $data1 = mysqli_fetch_array($hasil1);

                                    if ($pecah[0] == $data1[0])
                                    { 
                                     $keyword2 = $pecah[1];
                                       $query2 = "SELECT * FROM tbl_autorespon WHERE keyword2='$keyword2'";
                                       $hasil2 = mysqli_query($mysqli,$query2);
                                   
                                       if (mysqli_num_rows($hasil2) == 0)
                                       $reply = "Keyword tidak ditemukan";
                                       else
                                       {  
                                          $data2 = mysqli_fetch_array($hasil2);
                                          $pesan = $data2[3];
                                          $reply = $pesan;
                                       }
                                    }else{
                                     $reply = "Maaf perintah salah"; 
                                    } 

                                    if($data1['idforward']==1){
                                      $query6 = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES ('$data1[no_forward]', '$reply', 'Gammu')";
                                      $hasil6 = mysqli_query($mysqli,$query6);
                                    }   

                                    $query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID) VALUES ('$noPengirim', '$reply','Gammu')";
                                    $hasil3 = mysqli_query($mysqli,$query3);
                                   
                                    $query4 = "UPDATE inbox SET Processed = 'true' ";
                                    $hasil4 = mysqli_query($mysqli,$query4);    
                                    
                                  }
                                }

                                 

                                 $querycek = "SELECT * FROM inbox WHERE Processed = 'false'";
                                 $hasilcek = mysqli_query($mysqli,$querycek);
                                 while ($datacek = mysqli_fetch_array($hasilcek))
                                 {
                                  $nohp = $datacek['SenderNumber'];
                                  $id = $datacek['ID'];
                                  $teks = strtoupper($datacek['TextDecoded']);
                                  
                                  // cek apakah suatu SMS mengandung 1 atau lebih badwords
                                  $query2 = "SELECT * FROM tbl_filter_kata";
                                  $hasil2 = mysqli_query($mysqli,$query2);
                                  $status = 0;
                                  while ($data2 = mysqli_fetch_array($hasil2))
                                  {
                                   // jika SMS mengandung badwords, maka status = 1
                                   if (substr_count($teks, strtoupper($data2['nm_kata'])) > 0){
                                      $status=1;
                                   } 
                                  }
                                  
                                  // jika status = 1, lakukan penghapusan dan insert ke tabel sms_inbox
                                  if ($status == 1)
                                  {
                                   $inserttospam=mysqli_query($mysqli,"INSERT INTO inbox_spam (TextDecoded,SenderNumber,ReceivingDateTime ) values ('$teks','$nohp', NOW()) "); 
                                   $query3 = "DELETE FROM inbox WHERE ID = '$id'";
                                   mysqli_query($mysqli,$query3);
                                  }
                                 }
                                 $count=mysqli_query($mysqli,"select count(ID)as jum from inbox where Processed='false'");
                                 $row4=mysqli_fetch_array($count); 
                                 echo "" . $row4['jum'] . "";
                                
                                
                                ?>
                            </span>

</a>
                        <ul class="dropdown-menu extended inbox">
                          <div class="notify-arrow notify-arrow-green"></div>
                          <li>
                              <?php

                              $count2=mysqli_query($mysqli,"select count(ID)as jum from inbox where Processed='false' ");
                              while($row5=mysqli_fetch_array($count2)) {
                                  echo "<p class='green'> " . $row5['jum'] . " Pesan</p>";
                              }
                              ?>

                          </li>
                          <li>
                              <?php
                              $pesan=mysqli_query($mysqli,"select ID,SenderNumber,TextDecoded,
                          (select a.Name from pbk a where a.Number=b.SenderNumber) as Name,
                          (select a.Foto from pbk a where a.Number=b.SenderNumber) as Foto from inbox b 
                          where Processed='false' order by ReceivingDateTime DESC limit 5 ");
                              $cekpesan=mysqli_num_rows($pesan);
                              if ($cekpesan>='1')
                              {
                              while($row3=mysqli_fetch_array($pesan)) {
                                  echo "<a href='?id=inbox&mod=cek&idinbox=".$row3['ID']."'>
                                     
                                                          <span class='subject'>
                                        <span class='from'>".$row3['Name']."</span>
                                                          <span class='from'>".$row3['SenderNumber']."</span>
                                                          <span class='time'></span>
                                                          </span>
                                                          <span class='message'>
                                                              ".substr($row3['TextDecoded'],0,30)."
                                                          </span>
                                  </a>


                                  ";
                              }
                                  ?>
                                  <div hidden="hidden">
                                      <audio controls="controls" autoplay="autoplay">
                                          <source src="sound.mp3" type="audio/mpeg" />
                                          <embed src="sound.mp3" />
                                      </audio>
                                  </div>
                              <?php
                              }
                              ?>
                          </li>



                          <li>
                              <a href="?id=inbox">See all messages</a>
                          </li>
                        </ul>                            


