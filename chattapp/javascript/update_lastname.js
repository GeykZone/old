const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/update_lastname.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "Updated successfully"){

                  errorText.style.background = "darkgreen";
                  errorText.style.color = "lightgreen";
                  errorText.style.border = "darkgreen";
                  errorText.style.display = "block";
                  errorText.textContent = data;
                setTimeout(function()
                {
                  location.href="update_lastname.php";
                },990);

              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
