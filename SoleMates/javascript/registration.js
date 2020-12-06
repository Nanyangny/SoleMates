
function chkName(){
    var inputName = document.getElementById("username");
    var checkstring = inputName.value;
    const exp = /^([A-Za-z',.\s?]+)$/;
    if(!exp.test(checkstring)){
        alert('Please fill in your name. The username contains only alphabet characters and character space.');
        inputName.focus();
        inputName.select();
        return false;
    }
    else return true;
  }
  
  function chkEmail(){
      var inputEmail = document.getElementById("Email");
      var checkEmail = inputEmail.value.toString();
      const exp = /^[A-Za-z0-9]+@(\w+\.){1,3}\w{2,3}$/;
      if (!exp.test(checkEmail)){
          alert('Your email is not correct');
          inputEmail.focus();
          inputEmail.select();
          return false;
      }
      else return true;
  }
  
  function chkDate(){
      var inputDate = document.getElementById("birthday");
      var startDate = new Date(inputDate.value);
      var currentDate = new Date();
      if(startDate > currentDate){
          alert('You cannot select a date that is later than today!');
          inputDate.focus();
          inputDate.select();
          return false;
  
      }
      else return true;
  }
  
  function chkPassword(){
      var inputPassword = document.getElementById("password");
      var checkPassword = inputPassword.value.toString();
      const exp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
      if (!exp.test(checkPassword)){
          alert('Your password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters');
          inputPassword.focus();
          inputPassword.select();
          return false;
      }
      else return true;
  }
  
  function reCheck(){
      if(!chkName() || !chkEmail() || !chkDate() || !chkPassword()|| !matchPassword()){
          return false;
      }
      else return true;
  }
  
  function matchPassword(){
    var inputPassword = document.getElementById("password");
    var confirmPassword = document.getElementById('password2');
    if(confirmPassword.value ===inputPassword.value){
        return true;
    }
    else{
        alert("Please make sure two passwords are the same");
        return false;
    }

  }