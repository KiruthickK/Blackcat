function MakeSignUpVisible() {
    document.getElementById("login").style.display = "none";
    document.getElementById("signup").style.display = "block";
    document.getElementById("BtnLogIn").style.display = "none";
    document.getElementById("BtnSgnUp").style.display = "block";
}

function MakeLoginVisible() {
    document.getElementById("signup").style.display = "none";
    document.getElementById("login").style.display = "block";
    document.getElementById("BtnSgnUp").style.display = "none";
    document.getElementById("BtnLogIn").style.display = "block";

}