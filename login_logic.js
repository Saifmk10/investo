let emailId = document.getElementById("email_id");
let emailMessageError = document.getElementById("email-error-message");
let passwordInputs = document.getElementById("pin_input_decor");
let passwordMessageError = document.getElementById("pin-error-message");

let counter = 0;
let userIdIndex;


const arrayEmailDatabase = ["welcome"];
const arrayPasswordDatabase = ["1234"];


function getData(){ 
    let email = emailId.value.trim();
    let password = passwordInputs.value.trim();
    let found = 0;

    for(let i=0; i<arrayEmailDatabase.length; i++){
        if(email === arrayEmailDatabase[i]){
            console.log("email working");
            found = 1;
            userIdIndex = i;
            break;
        }
        else{
            console.log("email not working");
            found = 0;
        }
    }
    if(found === 1){
        emailMessageError.innerText = "User Email Found";
        emailMessageError.style.color = "#33FE00";

        if(password === arrayPasswordDatabase[userIdIndex]){
            console.log(" password working")
            passwordMessageError.innerText = "Authentication Successful";
            passwordMessageError.style.color = "#33FE00";

            // alert("User Aunthentication Completed")
            window.location.assign("home_page.html")
        }
        else{
            console.log("pin error");
            passwordMessageError.innerText = "Aunthentication Failed";
            passwordMessageError.style.color = "#FD2626";
        }
    }
    else{
        console.log("not working");
        emailMessageError.innerText = "User Email Not Found"
        emailMessageError.style.color = "#FD2626";
    }
    
}
