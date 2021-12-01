(function($) {

    $(document).ready(function(e) {


        var id_pbk = 0;
        var main = "autoschedule/autoschedule.data.php";

        $("#data-schedule").load(main);
		
        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-schedule").html(data).show();
                });
            } else {

                $("#data-schedule").load(main);
            }
        });


        $('.ubah,.tambah').live("click", function(){

            var url = "autoschedule/autoschedule.form.php";

            id_auto = this.id;
          

            if(id_auto != 0) {

                $("#myModalLabel").html("Ubah Data Schedule");
            } else {
                $("#myModalLabel").html("Tambah Data Schedule");
            }

           
                $.post(url, {id: id_auto} ,function(data) {
                    $(".auto").html(data).show();
                });
            
            
        });


        $('.hapus').live("click", function(){
            var url = "autoschedule/autoschedule.input.php";

            id_auto = this.id;

            var answer = confirm("Apakah anda ingin menghapus nama ini?");

            if (answer) {

                $.post(url, {hapus: id_auto} ,function() {

                    $("#data-schedule").load(main);
                });
            }
        });

        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-schedule").html(data).show();
            });
        });

        $("#simpan-auto").bind("click", function(event) {
            var url = "autoschedule/autoschedule.input.php";

            var vid_auto = $('input:text[name=id_auto]').val();

            var vwaktu= $('input:text[name=waktu]').val();

            var vpesan= $('textarea[name=pesansch]').val();

            var vnohp = $('#nohpsch').val();

            var vgroup = $('#groupauto').val();

            console.log(vgroup);

            if(vpesan==" "){
                $("#msg2").html('<font color="red">Pesan Harus di isi</font>').show();
            }else if(vwaktu==""){
                $("#msg3").html('<font color="red">Waktu Harus di isi</font>').show();
            }else{
                $.post(url, {id_auto: vid_auto, waktu: vwaktu, pesan: vpesan,nohp: vnohp,id: id_auto, group:vgroup},
                function() {
                    $("#data-schedule").load(main);
                    $("#dialog-auto").modal('hide');
                    $("#myModalLabel").html("Tambah Data AutoSchedule");

                });
            }

            
        });
    });
}) (jQuery);