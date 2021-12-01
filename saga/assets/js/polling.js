(function($) {

    $(document).ready(function(e) {


        var idpolling = 0;
        var main = "polling/polling.data.php";


        $("#data-polling").load(main);

        $('input:text[name=pencarian]').on('input',function(e){
            var v_cari = $('input:text[name=pencarian]').val();

            if(v_cari!="") {
                $.post(main, {cari: v_cari} ,function(data) {

                    $("#data-polling").html(data).show();
                });
            } else {

                $("#data-polling").load(main);
            }
        });


        $('.ubah,.tambah').live("click", function(){

            var url = "polling/polling.form.php";

            idpolling = this.id;

            if(idpolling != 0) {

                $("#myModalLabel").html("Ubah Data");
            } else {
                $("#myModalLabel").html("Tambah Data");
            }

            $.post(url, {id: idpolling} ,function(data) {
                $(".polling").html(data).show();
            });
        });


        $('.halaman').live("click", function(event){

            kd_hal = this.id;

            $.post(main, {halaman: kd_hal} ,function(data) {

                $("#data-polling").html(data).show();
            });
        });


    });
}) (jQuery);

