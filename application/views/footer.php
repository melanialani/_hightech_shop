</div>
<script>
    $(document).ready( function (){
        <?php if(!isset($notShowCart)) {?>
        $.post('<?php echo base_url('items/addToCart');?>', function(data){
            $('#shopping_link').html(data);
        });
        <?php }?>
        $('#shopping_link').on('click','.btnDeleteCart', function (e){
            var rowid = $(this).attr('data-id');
            $.post('<?php echo base_url('items/deleteFromCart');?>',{cart_rowid:rowid}, function(data){
                $('#shopping_link').html(data);
                $('#shopping_link a').dropdown('toggle');
            });
        });
    });
</script>
<footer class="footer">
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-8">
                Sekolah Tinggi Teknik Surabaya
            </div>
            <div class="col-md-4">
                <p class="muted pull-right">&copy; 2015 HighTech!Shop. All rights reserved</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>