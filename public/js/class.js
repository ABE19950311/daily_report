export class Login {
    constructor() {
        this.loginBtn = document.getElementById("login_btn")
        this.loginUser = document.getElementById("login_user")
        this.loginPassword = document.getElementById("login_password")
        this.loginRegisterBtn = document.getElementById("login_register_btn")
    }
}

export class Register {
    constructor() {
        this.user = document.getElementById("register_user")
        this.password = document.getElementById("register_password")
        this.submitBtn = document.getElementById("register_submit_btn")
        this.backLoginBtn = document.getElementById("register_back_login_btn")
    }
}

export class Header {
    constructor() {
        this.logoutBtn = document.getElementById("logout_btn")
        this.diaryListHomeBtn = document.getElementById("diary_list_home_btn")
        this.notificationTransitionBtn = document.getElementById("notification_register_btn")
        this.dailyDiaryBtn = document.getElementById("daily_diary_btn")
    }
}

export class Notification {
    constructor() {
        this.notification = document.getElementById("notification_address")
        this.notificationRecordBtn = document.getElementById("notification_record_btn")
        this.mailAddressParent = document.getElementById("mailAddressBody")
        this.mailAddressOrigin = document.getElementById("mailAddressList")
        this.notificationSubmitBtn = document.getElementById("notification_submit_btn")
    }
}

export class Report {
    constructor() {
        this.title = document.getElementById("report_title")
        this.sei = document.getElementById("report_sei")
        this.mei = document.getElementById("report_mei")
        this.radioCategory = document.querySelectorAll('input[name="category"]')
        this.content = document.getElementById("report_content")
        this.url = document.getElementById("report_url")
        this.image = document.getElementById("report_image")
        this.reportSubmitBtn = document.getElementById("report_submit_btn")
        this.showReportBtn = document.querySelectorAll(".show_report_btn")
        this.previousBtn = document.getElementById("pagenation_previous")
        this.nextBtn = document.getElementById("pagenation_next")
        this.pagenationBtn = document.querySelectorAll(".pagenation-item")
        this.checkCategory = null;
        this.currentPage = null;
    }

    set checkCategory(value) {
        this._checkCategory = value;
    }
    get checkCategory() {
        return this._checkCategory;
    }

    set currentPage(value) {
        this._currentPage = value;
    }
    get currentPage() {
        return this._currentPage;
    }
}

export class initialData {
    constructor() {
        this._userMailAddressList = [];
    }
    set userMailAddressList(value) {
        this._userMailAddressList = value;
    }
    get userMailAddressList() {
        return this._userMailAddressList;
    }
}