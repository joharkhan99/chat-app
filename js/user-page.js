var bar = document.querySelector('.users .search input');
var btn = document.querySelector('.users .search button');
var usersList = document.querySelector('.users .users-list');

btn.onclick = function () {
  bar.classList.toggle('show');
  bar.focus();
  btn.classList.toggle('active');
  bar.value = '';
}

// for searching
bar.onkeyup = () => {
  let query_name = bar.value;

  // the below cond is bcz we have more thank one ajax call on this page and it bcomes annoyinh
  if (query_name != '') {
    bar.classList.add('active');
  } else {
    bar.classList.remove('active');
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);

  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  }

  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
  xhr.send("search_query=" + query_name);   //send form data to aove url
}


// get data every half seconnd from db/php/server
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);

  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        //if search bar has no active class then add this
        if (!bar.classList.contains('active'))
          usersList.innerHTML = data;
      }
    }
  }

  xhr.send();   //send form data to aove url
}, 500);