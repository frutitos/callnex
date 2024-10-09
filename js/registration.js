$(document).ready(function(){
    $("#registerButton").click(function(){
        var userType = $("#userType").val();
        localStorage.setItem("userType", userType);
        window.location.href = "inicio.html"; // Redirige a la página de inicio
    });
});
