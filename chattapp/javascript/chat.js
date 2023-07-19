const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
refresher = document.querySelector("refresher");

getmessagess();
getusertabcookie();


//to create a conditional statement for 2 cookies so that it will only load table when new row is added
function getusertabcookie()
{
  //get cookie
  function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i=0; i<ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1);
          if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
      }
      return "";
  }

  var thissstab = getCookie("usertabCurrentTable");
  var updatedtab = getCookie("usertabupdatedTable");
  if(thissstab != updatedtab){
      getmessagess();
  }
  else {

  }
    setTimeout(getusertabcookie, 1000);
}




form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}


setInterval(() =>{

  ///////////////////
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "php/refresher.php", true);
   xhr.onload = ()=>{
     if(xhr.readyState === XMLHttpRequest.DONE){
         if(xhr.status === 200){
           let data = xhr.response;
           refresher.innerHTML = data;
           if(!refresher.classList.contains("active")){
               scrollToBottom();
             }
         }
     }
   }
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send("incoming_id="+incoming_id);
 ////////////////

}, 500);


function getmessagess() {
  ///////////////////
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "php/get-chat.php", true);
   xhr.onload = ()=>{
     if(xhr.readyState === XMLHttpRequest.DONE){
         if(xhr.status === 200){
           let data = xhr.response;
           chatBox.innerHTML = data;
           if(!chatBox.classList.contains("active")){
               scrollToBottom();
             }
         }
     }
   }
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send("incoming_id="+incoming_id);
 ////////////////
}


sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
    getmessagess();
}


chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}



function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
