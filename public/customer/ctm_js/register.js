var passwordField = document.getElementById("pass");
var eyesIcon = document.getElementById("eyes_icon");

eyesIcon.addEventListener("click",function(){
    if(passwordField.type === "password"){
        passwordField.type = "text";
    }else{
        passwordField.type = "password";
    }
});

var confirmpasswordField = document.getElementById("confirm_pass");
var eyesIcon2 = document.getElementById("eyes_icon2");

eyesIcon2.addEventListener("click",function(){
    if(confirmpasswordField.type === "password"){
        confirmpasswordField.type = "text";
    }else{
        confirmpasswordField.type = "password";
    }
});

var matchIcon = document.getElementById("match_icon");

confirmpasswordField.addEventListener("input", function(){
        if(confirmpasswordField.value === passwordField.value && confirmpasswordField.value !== ""){
            matchIcon.style.display = "inline";
        }else{
            matchIcon.style.display = "none";
        }
})