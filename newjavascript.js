$(document).ready(function() {
  $("#form").submit(
    function (event) {
      event.preventDefault();
    $.ajax({
      url: "mail.php",
      type: "post",
      data: $("#form").serialize();
    });
    return false;
  });
});
$("#b-{$model->id}").click(function () {
                $.ajax({
                    type: "POST",
                    url: "/basket/button",
                    data: {id:{$model->id},
                        plus:1},
                    success: function (mesg)
                    {
                        $('#result').html(mesg);
                        alert('sdfsdf');
                    }
                });
            return false;
            }
        );