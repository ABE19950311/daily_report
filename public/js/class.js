export class Login {
    constructor() {
        this.loginBtn = document.getElementById("login_btn") ? document.getElementById("login_btn") : null;
        this.loginUser = document.getElementById("login_user") ? document.getElementById("login_user") : null;
        this.loginPassword = document.getElementById("login_password") ? document.getElementById("login_password") : null;
        this.loginRegisterBtn = document.getElementById("login_register_btn") ? document.getElementById("login_register_btn") : null;
    }
}

export class Register {
    constructor() {
        this.user = document.getElementById("register_user") ? document.getElementById("register_user") : null;
        this.password = document.getElementById("register_password") ? document.getElementById("register_password") : null;
        this.submitBtn = document.getElementById("register_submit_btn") ? document.getElementById("register_submit_btn") : null;
        this.backLoginBtn = document.getElementById("register_back_login_btn") ? document.getElementById("register_back_login_btn") : null;
    }
}

export class Header {
    constructor() {
        this.logoutBtn = document.getElementById("logout_btn") ? document.getElementById("logout_btn") : null;
        this.diaryListHomeBtn = document.getElementById("diary_list_home_btn") ? document.getElementById("diary_list_home_btn") : null;
        this.notificationTransitionBtn = document.getElementById("notification_register_btn") ? document.getElementById("notification_register_btn") : null;
        this.dailyDiaryBtn = document.getElementById("daily_diary_btn") ? document.getElementById("daily_diary_btn") : null;
    }
}

export class Notification {
    constructor() {
        this.notification = document.getElementById("notification_address") ? document.getElementById("notification_address") : null;
        this.notificationRecordBtn = document.getElementById("notification_record_btn") ? document.getElementById("notification_record_btn") : null;
        this.mailAddressParent = document.getElementById("mailAddressBody") ? document.getElementById("mailAddressBody") :  null;
        this.mailAddressOrigin = document.getElementById("mailAddressList") ? document.getElementById("mailAddressList") : null;
        this.notificationSubmitBtn = document.getElementById("notification_submit_btn") ? document.getElementById("notification_submit_btn") : null;
    }
}

export class Report {
    constructor() {
        this.title = document.getElementById("report_title") ? document.getElementById("report_title") : null;
        this.sei = document.getElementById("report_sei") ? document.getElementById("report_sei") : null;
        this.mei = document.getElementById("report_mei") ? document.getElementById("report_mei") : null;
        this.radioCategory = document.querySelectorAll('input[name="category"]').length ? document.querySelectorAll('input[name="category"]') : null;
        this.content = document.getElementById("report_content") ? document.getElementById("report_content") : null;
        this.url = document.getElementById("report_url") ? document.getElementById("report_url") : null; 
        this.image = document.getElementById("report_image") ? document.getElementById("report_image") : null;
        this.reportSubmitBtn = document.getElementById("report_submit_btn") ? document.getElementById("report_submit_btn") : null;
        this.checkCategory = null;
    }

    set checkCategory(value) {
        this._checkCategory = value;
    }
    get checkCategory() {
        return this._checkCategory;
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