import * as page from "./class.js";
import * as request from "./request.js";

let register = null;
let header = null;

window.addEventListener("DOMContentLoaded",()=>{
    register = new page.Register();
    header = new page.Header();
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
        const res = await request.requestPageToServer(url,"GET")
        if(res.status==200) {
            window.location.href = url   
        } else {
            throw new Error("page not found")
        }
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
        if(res.statusCode==200) {
            window.location.href = res.redirect
        } else {
            throw new Error("register failed")
        }
    } catch(e) {
        console.error(e)
    }
}