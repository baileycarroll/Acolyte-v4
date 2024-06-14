
function swapForms() {
    var x = document.getElementById("registerForm");
    var y = document.getElementById("loginForm");
    var btn = document.getElementById("formSwitch");
    
    
    if (btn.innerHTML == "Register") {
        btn.innerHTML = "Login";
    }
    else {
        btn.innerHTML = "Register";
    }
    
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none";
    }
    else {
        x.style.display = "none";
        y.style.display = "block";
    }
}


function showDash() {
    var dash = document.getElementById("dashboard");
    var pass = document.getElementById("pass_reset");
    var member = document.getElementById("membership");
    var info = document.getElementById("my_info");

        dash.style.display = "block";
        pass.style.display = "none";
        member.style.display = "none";
        info.style.display = "none";
}

function showResPass() {
    var dash = document.getElementById("dashboard");
    var pass = document.getElementById("pass_reset");
    var member = document.getElementById("membership");
    var info = document.getElementById("my_info");

        dash.style.display = "none";
        pass.style.display = "block";
        member.style.display = "none";
        info.style.display = "none";
}

function showMembership() {
    var dash = document.getElementById("dashboard");
    var pass = document.getElementById("pass_reset");
    var member = document.getElementById("membership");
    var info = document.getElementById("my_info");

        dash.style.display = "none";
        pass.style.display = "none";
        member.style.display = "block";
        info.style.display = "none";
}

function showInfo() {
    var dash = document.getElementById("dashboard");
    var pass = document.getElementById("pass_reset");
    var member = document.getElementById("membership");
    var info = document.getElementById("my_info");

        dash.style.display = "none";
        pass.style.display = "none";
        member.style.display = "none";
        info.style.display = "block";
}



        
