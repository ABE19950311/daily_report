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
    header.diaryListHomeBtn.addEventListener("click",loadHomePage);
    header.notificationTransitionBtn.addEventListener("click",loadNotificationPage)
    notification.notificationRecordBtn.addEventListener("click",registerMailAddress);
}

async function isLogout() {
    const url = "https://192.168.64.6/isLogout"

    try {
        const res = await request.requestToServer(url,"POST",{})
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }
        document.cookie = "sessionToken=; max-age=0"
        loadLoginPage()
    } catch(e) {
        console.error(e)
    }
}

async function loadLoginPage() {
    const url = "https://192.168.64.6/"

    try {
        await request.requestPageToServer(url,"POST",{})
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    } 
}

async function loadNotificationPage() {
    const url = "https://192.168.64.6/notification"

    try {
        await request.requestPageToServer(url,"POST",{})
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    } 
}

async function loadHomePage() {
    const url = "https://192.168.64.6/home"

    try {
        await request.requestPageToServer(url,"POST",{})
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    } 
}

async function registerMailAddress() {
    const url = "https://192.168.64.6/isRegisterMailAddress"

    const body = {
        mailAddress: notification.notification.value
    }

    try {
        const res = await request.requestToServer(url,"POST",body)
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }

    } catch(e) {
        console.error(e)
    }

}