<script type="text/javascript">
    $(document).ready( function(){
        $("#dob").datepicker({
            format: "dd-mm-yyyy",
            locale: 'en',
            endDate: new Date(),
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: 'auto bottom',
        })
    });
</script>