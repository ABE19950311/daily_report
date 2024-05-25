import * as page from "./class.js";
import * as request from "./request.js";

let login = null;

window.addEventListener("DOMContentLoaded",()=>{
    login = new page.Login();
    main();
});

async function main() {
    initialEvents();
    if(await sessionCheck()) {
        loadPageHome();
    }
}

function initialEvents() {
    login.loginBtn.addEventListener("click",isExsistUserCheck);
}

async function loadPageHome() {

}

async function isExsistUserCheck() {
    const url = "https://192.168.64.6/isExsistCheck"
    const body = {
        loginUser: login.loginUser.value,
        loginPassword: login.loginPassword.value
    }
    const res = await request.requestToServer(url,"POST",body)
    if(res.applicationStatusCode=="Success") {
        hiddenAllPages();
        loadPageHome();
    }
}

async function sessionCheck() {
    const url = "https://192.168.64.6/isSessionCheck"

    const res = await request.requestToServer(url,"POST",{})
    console.log(res)
    if(res.applicationStatusCode=="Success") {
        return true
    } else {
        return false
    }
}