{/* <input type="text" id="datepicker" >


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

 <form id="login">
        <input type="text">
        <input type="text">
        <button type='submit'>submit</button>
    </form>

 

    <script>
        $('#login').submit((e)=>{
            e.preventDefault()
            $.ajax({
                type:"post",
                url:"<?php echo"$url/controller/administrative/user-management.php/createAccount" ?>",
                data:({user:"manako"}),
                success:function(res){
                        console.log(JSON.parse(res))
                },
                error:(e,er,err)=>{
                    console.log(e,er,err)
                }
            })
        })

    </script>


*/}


var array = ["2023-02-14","2023-02-15","2023-02-16"]
var dateToday = new Date("December 31 2005"); 
$( function() {
    $("#datepicker").datepicker({
        changeDate: true,
        changeMonth: true,
        changeYear: true,
        maxDate:dateToday,
        beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('yy/mm/dd', date);
                return [ array.indexOf(string) == -1 ]
            }
    });
} );