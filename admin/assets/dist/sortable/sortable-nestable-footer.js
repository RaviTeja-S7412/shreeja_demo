
   $(function () {
    $('.fm').nestable({
         maxDepth:1
        });
       

  //  $('.dd1').nestable();


    $('.fm').on('change', function () {
        var $this = $(this);
        var data = $(this).attr('fmid');

        var serializedData = window.JSON.stringify($($this).nestable('serialize'));
         //console.log($($this).nestable('serialize'));
        $this.parents('div.body').find('textarea').val(serializedData);
        //var url = "<?php echo base_url();?>"+'welcome/save_menu';
        var url = $('#base').val()+'navbar/Arrangemenu/save_footer_menu';
        $.ajax({
            type:"POST",
            url:url,
            data:{fmdata:serializedData},
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