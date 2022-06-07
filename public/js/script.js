function showPass() {
    var pass = document.querySelector("#password");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
