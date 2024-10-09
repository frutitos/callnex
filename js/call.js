$(document).ready(function(){
    $("#callButton").click(function(){
        var teacherName = $("#teacherName").val();
        var course = $("#course").val();
        var reason = $("#reason").val();
        
        var notificationText = "Llamando a " + teacherName + " del curso " + course + " por " + reason;
        $("#notificationText").text(notificationText);
        $(".notification").show();
    });

    $("#dismissButton").click(function(){
        $(".notification").hide();
    });
});
