const form = document.querySelector('.typing-area'),
  inputField = form.querySelector('.input-field'),
  sendBtn = form.querySelector('button'),
  chatBox = document.querySelector('.chat-box');


form.onsubmit = function (e) {
  e.preventDefault();
}

// sending message ajax
sendBtn.onclick = () => {

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-chat.php", true);

  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        inputField.value = '';    //after message is sent empty message field
        scrollToBottom();
      }
    }
  }

  let formData = new FormData(form);    //create formdata for form
  xhr.send(formData);   //send form data to aove url
}

// get messages every half sec
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);

  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;

        //if active class not contain in chatbox then scroll to bottom
        if (!chatBox.classList.contains('active'))
          scrollToBottom();
      }
    }
  }

  let formData = new FormData(form);    //create formdata for form
  xhr.send(formData);   //send form data to aove url
}, 500);

// when new message arrives then automatically scroll to bottom
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

chatBox.onmouseenter = () => {
  chatBox.classList.add('active');
}

chatBox.onmouseleave = () => {
  chatBox.classList.remove('active');
}