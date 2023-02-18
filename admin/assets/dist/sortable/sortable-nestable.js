
   $(function () {
    $('.mm').nestable({
         maxDepth:1
        });
       

//    $('#mm').nestable();


    $('.mm').on('change', function () {

        var $this = $(this);
        var data = $(this).attr('mid');

        var serializedData = window.JSON.stringify($($this).nestable('serialize'));
         //console.log($($this).nestable('serialize'));
        $this.parents('div.body').find('textarea').val(serializedData);
        //var url = "<?php echo base_url();?>"+'welcome/save_menu';
        var url = $('#base').val()+'navbar/Arrangemenu/save_menu';
        $.ajax({
            type:"POST",
            url:url,
            data:{mdata:serializedData},
 /*           dataType:"json",
            beforesend:function(){ alert(serializedData);},*/
            success:function(d){
                console.log(d);
            }

        });
    });

    $('.dd4').nestable();

    $('.dd4').on('change', function () {
        var $this = $(this);
        var serializedData = window.JSON.stringify($($this).nestable('serialize'));
    });
});