var nameNode = document.getElementById("username");
var dateNode = document.getElementById("birthday");
var emailNode = document.getElementById("Email");
var passwordNode = document.getElementById("password");



nameNode.addEventListener("change", chkName, false);
dateNode.addEventListener("change", chkDate, false);
emailNode.addEventListener("change", chkEmail, false);
passwordNode.addEventListener("change", chkPassword, false);
