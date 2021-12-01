<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Tulis Pesan</h4>
						      </div>
						      <div class="modal-body">
						        <form class="form-horizontal style-form" action="" method="post">


                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">To</label>
                        <div class="col-sm-3">
                            <select name="nohp[]"  id="nohp" class="form-control" multiple="multiple">
                                
                                 
                            </select>
                        </div>
                        <div class="col-sm-3">
                           * Cari No Hp / Nama 
                        </div>

                    </div>

								    <div class="form-group">
								        <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
								        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
								        </div>
								    </div>

                            
                    


						      <div class="modal-footer">

						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <input type="submit" class="btn btn-primary" name="input" value="KIRIM">
						      </div>
							  </form>
                              </div>
						    </div>
						  </div>
					</div>
					<div class="modal fade" id="modalsiaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">Pesan Siaran</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="form-horizontal style-form" action="" method="post">

                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Group</label>
                                          <div class="col-sm-10">
                                              <select name="group[]"  id="group" class="form-control" multiple="multiple">
                          
                                              </select>
                                              
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
                                          <div class="col-sm-10">
                                              <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
                                          </div>
                                      </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <input type="submit" class="btn btn-primary" name="inputgroup" value="KIRIM">
                              </div>
                              </form>
                          </div>
                      </div>
          </div>


          <div class="modal fade" id="modalsmsfilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">SMS Filter (Ceklis Terlebih dahulu)</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="form-horizontal style-form" action="" method="post">

                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                                          <div class="col-sm-5">
                                            <select name="idjab2" class="form-control">
                                              <option>-Pilih Jabatan-</option>
                                              <?php                          
                                              $jaba = mysqli_query($mysqli,"SELECT * FROM tbl_jabatan ORDER BY nmjab");
                                                  while($p=mysqli_fetch_array($jaba))
                                                  if ($p['idjab']==$idjab) {
                                                      echo "<option value=\"$p[idjab]\" selected>$p[nmjab]</option>\n";
                                                  } else{
                                                      echo "<option value=\"$p[idjab]\" >$p[nmjab]</option>\n";
                                                  }
                                              ?>
                                          </select>
                                          
                                          </div>
                                          <div class="col-sm-2">
                                            <input type="checkbox" name="cekjab" />
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Agama</label>
                                          <div class="col-sm-5">
                                              <select name="agama2" class="form-control">
                                                  <option>-Pilih Agama-</option>
                                                  <?php                          
                                                  $agam = mysqli_query($mysqli,"SELECT * FROM agama ORDER BY nama_agama");
                                                      while($p=mysqli_fetch_array($agam))
                                                      if ($p['nama_agama']==$agama) {
                                                          echo "<option value=\"$p[nama_agama]\" selected>$p[nama_agama]</option>\n";
                                                      } else{
                                                          echo "<option value=\"$p[nama_agama]\" >$p[nama_agama]</option>\n";
                                                      }
                                                  ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-2">
                                            <input type="checkbox" name="cekagama" />
                                          </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-3">
                                            <select name="jk2" class="form-control">
                                                <option>-Pilih Jenis Kelamin-</option>
                                                <?php                          
                                                $agam = mysqli_query($mysqli,"SELECT * FROM jk ORDER BY nama_jk");
                                                    while($p=mysqli_fetch_array($agam))
                                                    if ($p['id_jk']==$jk) {
                                                        echo "<option value=\"$p[id_jk]\" selected>$p[nama_jk]</option>\n";
                                                    } else{
                                                        echo "<option value=\"$p[id_jk]\" >$p[nama_jk]</option>\n";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                          <input type="checkbox" name="cekjk" form-control />
                                        </div>
                                    </div>


                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
                                          <div class="col-sm-10">
                                              <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
                                          </div>
                                      </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <input type="submit" class="btn btn-primary" name="inputfilter" value="KIRIM">
                              </div>
                              </form>
                          </div>
                      </div>
          </div>
				  
				  
				 <div class="modal fade" id="modalcekpulsa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Cek Pulsa</h4>
						      </div>
						      <div class="modal-body">
						        <form class="form-horizontal style-form" action="" method="post">

								  
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control " name="nopulsa" id="nopulsa" placeholder="contoh : *123#" required>
                                        
                                        </div>
                                    </div>


						      <div class="modal-footer">

						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <input type="submit" class="btn btn-primary" name="cekpulsa" value="CEK PULSA">
						      </div>
							  </form>
                              </div>
						    </div>
						  </div>
					</div>
