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
    login.loginRegisterBtn.addEventListener("click",loadUserRegisterPage)
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
        await request.requestPageToServer(url,"POST",{})
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    }  
}

async function isExsistUserCheck() {
    const url = "https://192.168.64.6/isExsistCheck"
    const body = {
        loginUser: login.loginUser.value,
        loginPassword: login.loginPassword.value
    }

    try {
        const res = await request.requestToServer(url,"POST",body)
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }
        window.location.href = `https://192.168.64.6/`
    } catch(e) {
        console.error(e)
    }
}

async function sessionCheck() {
    const url = "https://192.168.64.6/isSessionCheck"

    try {
        const res = await request.requestToServer(url,"POST",{})
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }
        return true
    } catch(e) {
        console.error(e)
        return false
    }
}