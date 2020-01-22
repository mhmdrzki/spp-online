<script>
$(function datepicker() {
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange:'-70:+5',
            dateFormat: "yy-mm-dd",
           onSelect: function(datetext){
        var d = new Date(); // for now
        datetext=datetext+" "+d.getHours()+": "+d.getMinutes()+": "+d.getSeconds();
        $('#datepicker').val(datetext);
    },
        });
    });
</script>