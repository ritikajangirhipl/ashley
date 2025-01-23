<script type="text/javascript">
    $(document).ready( function(){
        $('.amount_to_bill').hide();
        $('#payment_status').on('change', function() {
            console.log(this.value);
            if (this.value != 'fully_paid') {
                $('.amount_to_bill').show();
            }else{
                $('.amount_to_bill').hide();
            }
        });
    });
</script>