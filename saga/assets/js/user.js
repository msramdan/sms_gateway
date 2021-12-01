(function($) {

    $(document).ready(function(e) {
        
        var id = 0;
        var main = "user/data.php";

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


// ketika dipilih tombol hapus
// redirect ke file action di folder pelanggan
        $('.hapus').live("click", function(){
            var url = "user/action.php";

            id = this.id;

            var answer = confirm("Apakah anda ingin menghapus User ini?");

            if (answer) {

                $.post(url, {hapus: id} ,function() {

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

    });
}) (jQuery);
