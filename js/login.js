var form = document.querySelector('.login form'),
  sbmtBtn = form.querySelector('.button input'),
  errorText = form.querySelector('.error-txt');

form.onsubmit = function (e) {
  e.preventDefault();
}

sbmtBtn.onclick = function () {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);

  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        console.log(data);
        if (data == 'success') {
          location.href = 'users.php';
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  }

  let formData = new FormData(form);    //create formdata for form
  xhr.send(formData);   //send form data to aove url
}