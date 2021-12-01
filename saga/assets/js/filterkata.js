(function($) {

    $(document).ready(function(e) {


        var idkata = 0;
        var main = "filterkata/data.php";


        $("#data-group").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-group").html(data).show();
                });
            } else {

                $("#data-group").load(main);
            }
        });


        $('.ubahkata,.tambahkata').live("click", function(){

            var url = "filterkata/form.php";

            idkata = this.id;

            if(idkata != 0) {

                $("#myModalLabel").html("Ubah Data ");
            } else {
                $("#myModalLabel").html("Tambah Data");
            }

            $.post(url, {id: idkata} ,function(data) {
                $(".filterkata").html(data).show();
            });
        });


        $('.hapus').live("click", function(){
            var url = "filterkata/action.php";

            idkata = this.id;

            var answer = confirm("Apakah anda ingin menghapus data ini?");

            if (answer) {

                $.post(url, {hapus: idkata} ,function() {

                    $("#data-group").load(main);
                });
            }
        });

        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-group").html(data).show();
            });
        });

        $("#simpan-kata").bind("click", function(event) {
            var url = "filterkata/action.php";

            var vidkata = $('input:text[name=idkata]').val();
            var vnmkata= $('input:text[name=nmkata]').val();
            if(vnmkata==""){
                $("#msg1").html('<font color="red">* Harus di isi</font>').show();
            }else{
                $.post(url, {idkata: vidkata, nmkata: vnmkata,id: idkata},function() {
                    $("#data-group").load(main);
                    $("#dialog-group").modal('hide');
                    $("#myModalLabel").html("Tambah Data");

                });
            }
            
        });
    });
}) (jQuery);