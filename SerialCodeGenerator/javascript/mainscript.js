function generateSerial() {

    'use strict';

    var chars = '123456789012345678901234567890123456789012345678901234567890',

        serialLength = 10,

        randomSerial = "",

        i,

        randomNumber;

    for (i = 0; i < serialLength; i = i + 1) {

        randomNumber = Math.floor(Math.random() * chars.length);

        randomSerial += chars.substring(randomNumber, randomNumber + 1);

    }

    var serial = randomSerial;

    document.getElementById("serial_code_id").value = ("SC:" + serial.toString());

}


function empty() {
	 if(document.getElementById("product_name_id").value==="") {
            document.getElementById('generate_button').disabled = true;
        } else {
            document.getElementById('generate_button').disabled = false;
        }
    }


function validateForm()
{
      var x = document.forms["main_form"]["serial_code_input"].value;
      if (x == "") {
        alert("Serial Code is Missing!");
        return false;
      }
    }
