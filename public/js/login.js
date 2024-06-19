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
        if(res.statusCode==200) {
            return true  
        } else {
            throw new Error("page not found")
        }
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
        window.location.href = url
    } catch(e) {
        console.error(e)
    }  
}

async function loadUserRegisterPage() {
    const url = "https://192.168.64.6/register"

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

async function isExsistUserCheck() {
    const url = "https://192.168.64.6/login"
    const body = {
        user: login.loginUser.value,
        password: login.loginPassword.value
    }

    try {
        const res = await request.requestToServer(url,"POST",body)
        console.log(res)
        if(res.statusCode==200) {
            loadPageHome()
        } else {
            throw new Error("user dose not exsist")
        }
    } catch(e) {
        console.error(e)
    }
}