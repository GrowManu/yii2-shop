<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $(".flip1").click(function(){
    $(".panel1").slideToggle("slow");
  });
  $(".flip2").click(function(){
    $(".panel2").slideToggle("slow");
  });
});
</script>
<style> 
.flip, .panel{
  padding: 5px;
  /*padding-right: 10px;*/
  text-align: left;
  /*background-color: #e5eecc;*/
  border: solid 1px #c3c3c3;
}

.panel1, .panel2{
  padding: 5px;
  display: none;
}
</style>
</head>
<body>
 
    <div class="flip1"><a href="#">Категория 1</a></div>
<div class="panel1">__Подкатегория 1.1</div>
<div class="panel1">__Подкатегория 2.1</div>
<div class="flip2"><a href="#">Категория 2</a></div>
<div class="panel2">__Подкатегория 2.1</div>
<div class="panel2">__Подкатегория 2.2</div>

</body>
</html>
