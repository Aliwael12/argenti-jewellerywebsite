
function validateName() {

      var Namex = document.getElementById('Name').value;

      if(Namex.length == 0) {

        producePrompt('Name is required', 'name-error' , 'red')
        return false;

    }

    if (!Namex.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/)) {

        producePrompt('First and last name, please.','name-error', 'red');
        return false;

    }

    producePrompt('Valid', 'name-error', 'green');
    return true;

}
function validateEmail () {

  var Emailx = document.getElementById('Email').value;

  if(Emailx.length == 0) {

    producePrompt('Email Invalid','email-error', 'red');
    return false;

}

if(!Emailx.match(/^[A-Za-z\._\-[0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)) {

    producePrompt('Email Invalid', 'email-error', 'red');
    return false;

}

producePrompt('Valid', 'email-error', 'green');
return true;

}
function validateMessage() {
  var Msgx = document.getElementById('Msg').value;
  var required = 30;
  var left = required - Msgx.length;

  if (left > 0) {
    producePrompt(left + ' more characters required','message-error','red');
    return false;
}

producePrompt('Valid', 'message-error', 'green');
return true;

}
function validateForm() {
  if (!validateName()  || !validateEmail() || !validateMessage()) {
    jsShow('submit-error');
    producePrompt('Please fix errors to submit.', 'submit-error', 'red');
    setTimeout(function(){jsHide('submit-error');}, 2000);
    return false;
}

 function validateclear() {
  var x= document.getElementById("submit-error");
     x.clear();
     
}   
    
    
}
function jsShow(id) {
  document.getElementById(id).style.display = 'block';
}

function jsHide(id) {
  document.getElementById(id).style.display = 'none';
}


function producePrompt(message, promptLocation, color) {

  document.getElementById(promptLocation).innerHTML = message;
  document.getElementById(promptLocation).style.color = color;

}