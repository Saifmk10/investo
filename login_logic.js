let emailId = document.getElementById("email_id");
let emailMessageError = document.getElementById("email-error-message");

let counter = 0;



const arrayEmailDatabase = ["saifmohasaif216@gmail.com"];

function getData(){ 
    let email = emailId.value;
    let found = 0;

    for(let i=0; i<arrayEmailDatabase.length; i++){
        if(email === arrayEmailDatabase[i]){
            console.log("working");
            found = 1;
            break;
        }
        else{
            console.log("not working");
            found = 0;
        }
    }
    if(found === 1){
        emailMessageError.innerText = "User Email Found";
        emailMessageError.style.color = "#33FE00";
    }
    else{
        console.log("not working");
        emailMessageError.innerText = "User Email Not Found"
        emailMessageError.style.color = "#FD2626";
    }
}