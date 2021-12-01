(function($) {

    $(document).ready(function(e) {


        var idjab = 0;
        var main = "jabatan/data.php";


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


        $('.ubah,.tambah').live("click", function(){

            var url = "jabatan/form.php";

            idjab = this.id;

            if(idjab != 0) {

                $("#myModalLabel").html("Ubah Data Jabatan");
            } else {
                $("#myModalLabel").html("Tambah Data Jabatan");
            }

            $.post(url, {id: idjab} ,function(data) {
                $(".jabat").html(data).show();
            });
        });


        $('.hapus').live("click", function(){
            var url = "jabatan/action.php";

            idjab = this.id;

            var answer = confirm("Apakah anda ingin menghapus jabatan ini?");

            if (answer) {

                $.post(url, {hapus: idjab} ,function() {

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

        $("#simpan-jabatan").bind("click", function(event) {
            var url = "jabatan/action.php";

            var vidjab = $('input:text[name=idjab]').val();
            var vnmjab= $('input:text[name=nmjab]').val();

            if(vnmjab==""){
                $("#msg1").html('<font color="red">* Harus di isi</font>').show();
            }else{
                $.post(url, {idjab: vidjab, nmjab: vnmjab,id: idjab},function(res) {
                    $("#data-group").load(main);
                    $("#dialog-group").modal('hide');
                    $("#myModalLabel").html("Tambah Data Jabatan");
                    $("#msg").html(res);
                });
            }
        });
    });
}) (jQuery);