import * as page from "./class.js";
import * as request from "./request.js";

let home = null;
let header = null;
let notification = null;
let initialData = null;
let report = null;

window.addEventListener("DOMContentLoaded",()=>{
    try {
        home = new page.Home();
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
    //ページネーション用に現在のページをセッターにセットする
    initialReportCurrentPage();
    //title検索欄の値をセッターにセットする
    //セットした値で検索状態を継続してページ遷移する
    initialTitleSearchValue()
    initialCategorySearchValue()
}

function initialEvents() {
    if(header.logoutBtn) header.logoutBtn.addEventListener("click",isLogout);
    if(header.diaryListHomeBtn) header.diaryListHomeBtn.addEventListener("click",loadHomePage);
    if(header.notificationTransitionBtn) header.notificationTransitionBtn.addEventListener("click",loadNotificationPage)
    if(header.dailyDiaryBtn) header.dailyDiaryBtn.addEventListener("click",loadReportPage);
    if(notification.notificationRecordBtn) notification.notificationRecordBtn.addEventListener("click",registerMailAddress);
    if(notification.notificationSubmitBtn) notification.notificationSubmitBtn.addEventListener("click",sendMailAddressList);
    if(report.reportSubmitBtn) report.reportSubmitBtn.addEventListener("click",submissionReport);
    if(report.updateReportSubmitBtn) report.updateReportSubmitBtn.addEventListener("click",isUpdateReport)
    if(report.previousBtn) report.previousBtn.addEventListener("click", {flag:"previous",page:null,handleEvent:updateCurrentPage})
    if(report.nextBtn) report.nextBtn.addEventListener("click", {flag:"next",page:null,handleEvent:updateCurrentPage})
    if(home.titleSearchBtn) home.titleSearchBtn.addEventListener("click", setTitleSearchValue)
    if(home.categorySearchBtn) home.categorySearchBtn.addEventListener("click",loadHomePage)
    //smartyで作成したreportListをquerySelectorAll使って配列でdom要素受け取る
    //forEachで取得要素にevent付与してく
    if(report.showReportBtn.length) {
        report.showReportBtn.forEach((elm)=>{
            elm.addEventListener("click",{id:elm.value,handleEvent:isShowReport})
        })
    }
    if(report.navigateToUpdateReportBtn.length) {
        report.navigateToUpdateReportBtn.forEach((elm)=>{
            elm.addEventListener("click",{id:elm.value,handleEvent:navigateToReportPage})
        })
    }
    if(report.deleteReportBtn.length) {
        report.deleteReportBtn.forEach((elm)=>{
            elm.addEventListener("click",{id:elm.value,handleEvent:isDeleteReport})
        })
    }
    if(report.radioCategory) {
        report.radioCategory.forEach((radio)=>{
            radio.addEventListener("change",(event)=>{
                report.checkCategory = event.target.value
            });
        })
    }
    if(report.updateRadioCategory) {
        report.updateRadioCategory.forEach((radio)=>{
            radio.addEventListener("change",(event)=>{
                report.updateCheckCategory = event.target.value
            })
        })
    }
    if(report.pagenationBtn.length) {
        report.pagenationBtn.forEach((elm)=>{
            elm.addEventListener("click",{flag:null,page:elm.value,handleEvent:updateCurrentPage})
        })
    }
    if(home.categorySearch) {
        home.categorySearch.addEventListener("change",(event)=>{
            home.categorySearchVal = event.target.value
        })
    }
}

function initialReportCurrentPage() {
    const url = window.location.href
    const urlObj = new URL(url)
    const params = new URLSearchParams(urlObj.search);
    const page = params.get('page');
    if(page) {
        report.currentPage = page
    }
}

function initialTitleSearchValue() {
    home.titleSearchVal = home.titleSearch.value
}

function initialCategorySearchValue() {
    const categoryIndex = home.categorySearch.selectedIndex
    const category = home.categorySearch.options[categoryIndex].value
    home.categorySearchVal = category
    console.log(home.categorySearchVal)
}

async function isLogout() {
    const url = "https://192.168.64.6/logout"

    try {
        const res = await request.requestToServer(url,"GET")
        if(res.statusCode==200) {
            document.cookie = "sessionToken=; max-age=0"
            loadLoginPage()
        } else {
            throw new Error("error")
        }
    } catch(e) {
        console.error(e)
    }
}

async function loadLoginPage() {
    const url = "https://192.168.64.6/login"

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = url
    } catch(e) {
        console.error(e)
    } 
}

async function loadHomePage() {
    const page = report.currentPage ? report.currentPage : 1
    const titleSearch = home.titleSearchVal ? home.titleSearchVal : ""
    const categorySearch = home.categorySearchVal ? home.categorySearchVal : ""
    
    const params = {
            page:page,
            titleSearch:titleSearch,
            categorySearch:categorySearch
        }
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/home?${query}`

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = url
    } catch(e) {
        console.error(e)
    } 
}

async function loadNotificationPage() {
    const url = "https://192.168.64.6/mail"

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = url
    } catch(e) {
        console.error(e)
    } 
}

async function registerMailAddress() {
    const url = "https://192.168.64.6/mail"

    const body = {
        mailAddress: notification.notification.value
    }

    try {
        const res = await request.requestToServer(url,"POST",body)
        if(res.statusCode==200) {
            loadHomePage()
        } else {
            throw new Error("register failed")
        }
    } catch(e) {
        console.error(e)
    }
}

async function sendMailAddressList() {
    const url = "https://192.168.64.6/mail/list"

    try {
        const res = await request.requestToServer(url,"GET")
        if(res.statusCode!=200) {
            throw new Error("register failed")
        }
    } catch(e) {
        console.error(e)
    }
}

async function loadReportPage() {
    const url = "https://192.168.64.6/report"

    try {
        await request.requestPageToServer(url,"GET")
        window.location.href = url
    } catch(e) {
        console.error(e)
    } 
}

async function submissionReport() {
    const apiUrl = "https://192.168.64.6/report"

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
        if(res.statusCode==200) {
            loadHomePage()
        } else {
            throw new Error("register failed")
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
    const url = `https://192.168.64.6/report/show?${query}`

    try {
        const res = await request.requestPageToServer(url,"GET")
        window.location.href = url
    } catch(e) {
        console.error(e)
    }
}

async function isUpdateReport() {
    const params = {reportid:report.updateReport.value}
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/report?${query}`

    const body = {
        title: report.updateTitle.value,
        sei: report.updateSei.value,
        mei: report.updateMei.value,
        category: report.updateCheckCategory,
        content: report.updateContent.value,
        url: report.updateUrl.value,
        image_path: report.updateImage.value
    }

    try {
        const res = await request.requestToServer(url,"PUT",body)
        if(res.statusCode==200) {
            loadHomePage()
        } else {
            throw new Error("register failed")
        }
    } catch(e) {
        console.error(e)
    }
}

async function isDeleteReport(id) {
    if(this.id) {
        id = this.id
    }
    const params = {reportid:id}
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/report?${query}`

    try {
        const res = await request.requestToServer(url,"DELETE")
        if(res.statusCode==200) {
            loadHomePage()
        } else {
            throw new Error("register failed")
        }
    } catch(e) {
        console.error(e)
    }
}

async function navigateToReportPage(id) {
    if(this.id) {
        id = this.id
    }

    const params = {reportid:id}
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/report/update?${query}`

    try {
        const res = await request.requestPageToServer(url,"GET")
        window.location.href = url
    } catch(e) {
        console.error(e)
    }
}

function updateCurrentPage(flag,page) {
    if(this.flag) {
        flag = this.flag
    }
    if(this.page) {
        page = this.page
    }

    let currentPage = report.currentPage
    let pagenationAllList = report.pagenationBtn.length

    switch(flag) {
        case "previous":
            if(currentPage<=1) return
            report.currentPage = --currentPage
        break;
        case "next":
            if(currentPage>=pagenationAllList) return
            report.currentPage = ++currentPage
        break;
        default:
            report.currentPage = page
        break;
    }

    loadHomePage()
}

function setTitleSearchValue() {
    home.titleSearchVal = home.titleSearch.value
    loadHomePage()
}