import * as page from "./class.js";
import * as request from "./request.js";

let login = null;
let register = null;
let header = null;
let notification = null;
let initialData = null;
let report = null;

window.addEventListener("DOMContentLoaded",()=>{
    try {
        login = new page.Login();
        register = new page.Register();   
        header = new page.Header();
        notification = new page.Notification();
        initialData = new page.initialData();
        report = new page.Report();
        main();
    } catch(e) {
        console.error(e)
    }
});

async function main() {
    initialEvents();
}

function initialEvents() {
    if(header.logoutBtn) header.logoutBtn.addEventListener("click",isLogout);
    if(header.diaryListHomeBtn) header.diaryListHomeBtn.addEventListener("click",loadHomePage);
    if(header.notificationTransitionBtn) header.notificationTransitionBtn.addEventListener("click",loadNotificationPage)
    if(header.dailyDiaryBtn) header.dailyDiaryBtn.addEventListener("click",loadDaiyDiaryPage);
    if(notification.notificationRecordBtn) notification.notificationRecordBtn.addEventListener("click",registerMailAddress);
    if(notification.notificationSubmitBtn) notification.notificationSubmitBtn.addEventListener("click",sendMailAddressList);
    if(report.reportSubmitBtn) report.reportSubmitBtn.addEventListener("click",submissionReport);
    //smartyで作成したreportListをquerySelectorAll使って配列でdom要素受け取る
    //forEachで取得要素にevent付与してく
    if(report.showReportBtn.length) {
        report.showReportBtn.forEach((elm)=>{
            elm.addEventListener("click",{id:elm.value,handleEvent:isShowReport})
        })
    }
    if(report.radioCategory) {
        report.radioCategory.forEach((radio)=>{
            radio.addEventListener("change",(event)=>{
                report.checkCategory = event.target.value
            });
        })
    }
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

async function loadDaiyDiaryPage() {
    const url = "https://192.168.64.6/daily"

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

async function sendMailAddressList() {
    const url = "https://192.168.64.6/isSendMailAddressList"

    try {
        const res = await request.requestToServer(url,"POST",{})
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }

    } catch(e) {
        console.error(e)
    }
}

async function submissionReport() {
    const apiUrl = "https://192.168.64.6/isRegisterReport"

    const body = {
        title: report.title.value,
        sei: report.sei.value,
        mei: report.mei.value,
        category: report.checkCategory,
        content: report.content.value,
        url: report.url.value,
        image_path: report.image.value
    }

    try {
        const res = await request.requestToServer(apiUrl,"POST",body)
        if(res.applicationStatusCode=="problem_process") {
            throw new Error(res.applicationMessage)
        }

    } catch(e) {
        console.error(e)
    }   
}

async function isShowReport(id) {
    if(this.id) {
        id = this.id
    }

    const params = {reportid:id}
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/isShowReport?${query}`

    try {
        const res = await request.requestPageToServer(url,"GET")
        window.location.href = `${url}`
    } catch(e) {
        console.error(e)
    }
}