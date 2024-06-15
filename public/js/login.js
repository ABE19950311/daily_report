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
    } else {
        displayLoginPage()
    }
}

function initialEvents() {
    login.loginBtn.addEventListener("click",isExsistUserCheck);
    login.loginRegisterBtn.addEventListener("click",loadUserRegisterPage)
}

function displayLoginPage() {
    login.loginPage.classList.remove("d-none")
}

async function sessionCheck() {
    const url = "https://192.168.64.6/session"

    try {
        const res = await request.requestToServer(url,"GET")
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }
        return true
    } catch(e) {
        console.error(e)
        return false
    }
}

async function loadPageHome() {
    const params = {page:1}
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/home?${query}`

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    }  
}

async function loadUserRegisterPage() {
    const url = "https://192.168.64.6/register"

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    }  
}

async function isExsistUserCheck() {
    const url = "https://192.168.64.6/login"
    const body = {
        loginUser: login.loginUser.value,
        loginPassword: login.loginPassword.value
    }

    try {
        const res = await request.requestToServer(url,"POST",body)
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }
        loadPageHome()
    } catch(e) {
        console.error(e)
    }
}