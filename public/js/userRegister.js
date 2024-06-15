import * as page from "./class.js";
import * as request from "./request.js";

let register = null;

window.addEventListener("DOMContentLoaded",()=>{
    register = new page.Register();
    main();
});

async function main() {
    initialEvents();
}

function initialEvents() {
    register.backLoginBtn.addEventListener("click",loadLoginPage);
    register.submitBtn.addEventListener("click",isUserRegister);
}

async function loadLoginPage() {
    const url = "https://192.168.64.6/login"

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    }    
}

async function isUserRegister() {
    const url = "https://192.168.64.6/register"

    const body = {
        user: register.user.value,
        password: register.password.value
    }

    try {
        const res = await request.requestToServer(url,"POST",body)
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }
        loadLoginPage()
    } catch(e) {
        console.error(e)
    }
}