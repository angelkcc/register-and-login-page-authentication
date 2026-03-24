const registerForm= document.forms.registerForm;
const fullNameElement= registerForm.fullname;
const emailElement= registerForm.email;
const passwordElement= registerForm.password;
const confirmPasswordElement= registerForm.confirmpassword;

registerForm.addEventListener('submit', function(event) {
    event.preventDefault();

    let isValid= true;

    function showError(elementName, errorMsg)
    {
        const errorElement = document.getElementById(elementName+ "ErrorText");
        errorElement.innerText=errorMsg;
        const element= registerForm[elementName];
        element.classList.add("error-input");
        isValid= false;
    }

    //Name Validation
    if (fullNameElement.value == "") {
        showError("fullname", "Name is required");
    }

    //Email Validation
    if(/^\w+@\w\.\w{2,3}$/.test(emailElement.value)===false){
        showError("email", "Email is invalid");
    }

    //Password Validation
    if(passwordElement.value == ""){
        showError("password", "Password is required");
    }

    //ConfimPassword
    if(confirmPasswordElement.value != passwordElement.value){
        showError("confirmpassword", "Password does not match");
    }

    if(isValid){
        registerForm.submit();
    }
    
})