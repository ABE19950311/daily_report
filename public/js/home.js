import * as page from "./class.js";
import * as request from "./request.js";

let login = null;
let register = null;
let header = null;
let notification = null;
let initialData = null;

window.addEventListener("DOMContentLoaded",()=>{
    login = new page.Login();
    register = new page.Register();   
    header = new page.Header();
    notification = new page.Notification();
    initialData = new page.initialData();
    main();
});

async function main() {
    initialEvents();
}

function initialEvents() {
    header.logoutBtn.addEventListener("click",isLogout);
}

async function isLogout() {
    const url = "https://192.168.64.6/isLogout"

    const res = await request.requestToServer(url,"POST",{})

    if(res.applicationStatusCode=="Success") {
        document.cookie = "sessionToken=; max-age=0"
        loadLoginPage()
    }
}

async function loadLoginPage() {
    const url = "https://192.168.64.6/"

    const resError = await request.requestPageToServer(url,"POST",{})
    if(resError!=true) {
        console.error(resError)
    } else {
        window.location.href = `${url}`
    }
}