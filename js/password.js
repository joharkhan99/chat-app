var eye = document.querySelector('.fa-eye');
var pass = document.getElementById('password');

eye.addEventListener('click', function () {
  if (pass.getAttribute('type') == 'password') {
    pass.setAttribute('type', 'text');
    eye.classList.add('active');
  }
  else if (pass.getAttribute('type') == 'text') {
    pass.setAttribute('type', 'password');
    eye.classList.remove('active');
  }
})
