import * as page from "./class.js";

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
    hiddenAllPages();
    hiddenHeader("header")
    initialEvents();
    if(await sessionCheck()) {
        loadPageHome();
    } else {
        appearPage("login_page");
    }
}

function hiddenAllPages() {
    const pages = document.querySelectorAll(".page_class");
    pages.forEach((page)=>{
        page.classList.add("d-none");
    })
}

function initialEvents() {
    const pageObj = {
        register_page: {id: "register_page"},
        login_page: {id: "login_page"},
        home_page: {id: "home_page"},
        daily_diary_page: {id: "daily_diary_page"},
        notification_register_page: {id: "notification_register_page"}
    }
    const btnObj = {
        register_page: ["login_register_btn"],
        login_page: ["register_back_login_btn"],
        home_page: ["diary_list_home_btn"],
        daily_diary_page: ["daily_diary_btn"],
        notification_register_page: ["notification_register_btn"]
    }
    Object.keys(btnObj).forEach((pages)=>{
        btnObj[pages].forEach((btn)=>{
            console.log(btn)
            document.getElementById(btn).addEventListener("click",(event)=>{
                event.preventDefault();//preventDefaultでデフォルトの動作を消す。これで送信時再リクエストおよび再リロードを防げる。
                //preventDefaultなしだと再リクエストをnginxになげてログイン画面再描画する
                //そもそもformタグ使わなかったら良い
                //https://qiita.com/yokoto/items/27c56ebc4b818167ef9e
                displayPage(pageObj[pages])//jsで定義したd-none付け替えによるページ遷移ができるようになる
            })
        })
    });
    login.loginBtn.addEventListener("click",isExsistUserCheck);
    register.submitBtn.addEventListener("click",registerUser);
    header.logoutBtn.addEventListener("click",isLogout);
    notification.notificationRecordBtn.addEventListener("click",isRegisterMailAddress);
    notification.notificationTransitionBtn.addEventListener("click",setMailAddress);
}

async function isRegisterMailAddress() {
    const url = "https://192.168.64.6/isRegisterMailAddress"
    const body = {
        mailAddress: notification.notification.value
    }
    const res = await requestToServer(url,"POST",body)
    console.log(res)
}

async function loadPageHome() {
    //await Promise.all([getUserMailAddressList()]);
    appearPage("home_page");
    appearPage("header");
}

async function isExsistUserCheck() {
    const url = "https://192.168.64.6/isExsistCheck"
    const body = {
        loginUser: login.loginUser.value,
        loginPassword: login.loginPassword.value
    }
    const res = await requestToServer(url,"POST",body)
    if(res.applicationStatusCode=="Success") {
        hiddenAllPages();
        loadPageHome();
    }
}

async function sessionCheck() {
    const url = "https://192.168.64.6/isSessionCheck"

    const res = await requestToServer(url,"POST",{})
    console.log(res)
    if(res.applicationStatusCode=="Success") {
        return true
    } else {
        return false
    }
}

async function isLogout() {
    const url = "https://192.168.64.6/isLogout"

    const res = await requestToServer(url,"POST",{})

    if(res.applicationStatusCode=="Success") {
        document.cookie = "sessionToken=; max-age=0"
        hiddenAllPages();
        hiddenHeader("header")
        appearPage("login_page");
    }
}

async function getUserMailAddressList() {
    const url = "https://192.168.64.6/getUserMailAddress";

    const res = await requestToServer(url,"POST",{})

    if(res.applicationStatusCode=="Success") {
        initialData.userMailAddressList = res.mailAddressList
    }
}

async function setMailAddress() {
    await getUserMailAddressList()
    const parent = notification.mailAddressParent
    const addressList = initialData.userMailAddressList
    //cloneNodeで増やしたelm消さないと同じnodeが増え続ける
    document.querySelectorAll("#mailAddressList:not(.d-none)").forEach(elm => elm.remove())
    addressList.forEach((address,index)=>{
        const node = notification.mailAddressOrigin.cloneNode(true)
        node.querySelector("#addressList1").innerText = index+1
        node.querySelector("#addressList2").innerText = address
        node.classList.remove("d-none")
        parent.appendChild(node)
    })
}

function displayPage(page) {
    console.log(page.id);
    hiddenAllPages();
    appearPage(page.id);
}

function appearPage(id) {
    document.getElementById(id).classList.remove("d-none");
}

function hiddenHeader(id) {
    document.getElementById(id).classList.add("d-none");
}

async function registerUser() {
    const url = "https://192.168.64.6/isRegisterUser";
    const body = {
        user: register.user.value,
        password: register.password.value
    }
    const res = await requestToServer(url,"POST",body)
    console.log(res)
}

async function requestToServer(url,method,body) {
    const option = {
        method: method,
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(body)
    }
    try {
        const res = await fetch(url,option)
        const data = await res.json()
        console.log(data)
        return data
    } catch(e) {
        console.error(e)
        throw e
    }
}