(function($) {

    $(document).ready(function(e) {


        var id_pbk = 0;
        var main = "autorespon/auto.data.php";


        $("#data-auto").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-auto").html(data).show();
                });
            } else {

                $("#data-auto").load(main);
            }
        });


        $('.ubah,.tambah').live("click", function(){

            var url = "autorespon/auto.form.php";

            id_auto = this.id;

            if(id_auto != 0) {

                $("#myModalLabel").html("Ubah Data Phonebook");
            } else {
                $("#myModalLabel").html("Tambah Data Phonebook");
            }

            $.post(url, {id: id_auto} ,function(data) {
                $(".auto").html(data).show();
            });
        });


        $('.hapus').live("click", function(){
            var url = "autorespon/auto.input.php";

            id_auto = this.id;

            var answer = confirm("Apakah anda ingin menghapus nama ini?");

            if (answer) {

                $.post(url, {hapus: id_auto} ,function() {

                    $("#data-auto").load(main);
                });
            }
        });

        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-auto").html(data).show();
            });
        });

        $("#simpan-auto").bind("click", function(event) {
            var url = "autorespon/auto.input.php";

            var vid_auto = $('input:text[name=id_auto]').val();

            var vkeyword1= $('input:text[name=keyword1]').val();

            var vkeyword2= $('input:text[name=keyword2]').val();

            var vidforward= $('#idforward').val();
            console.log(vidforward);
            var vno_forward= $('#no_forward').val();

            var vresult1 = $('textarea[name=result1]').val();

            if(vkeyword1==""){
                $("#msg1").html('<font color="red">* Harus di isi</font>').show();
            }else if(vkeyword2==""){
                $("#msg2").html('<font color="red">* Harus di isi</font>').show();
            }else if(vresult1==""){
                $("#msg3").html('<font color="red">* Harus di isi</font>').show();
            }else {
                $.post(url, {id_auto: vid_auto, keyword1: vkeyword1,
                keyword2: vkeyword2,idforward: vidforward,no_forward: vno_forward,result1: vresult1,id: id_auto},function() {
                $("#data-auto").load(main);
                $("#dialog-auto").modal('hide');
                $("#myModalLabel").html("Tambah Data Auto");

                });
            }

            
        });
    });
}) (jQuery);