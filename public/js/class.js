export class Login {
    constructor() {
        this.loginBtn = document.getElementById("login_btn");
        this.loginUser = document.getElementById("login_user");
        this.loginPassword = document.getElementById("login_password");
        this.loginRegisterBtn = document.getElementById("login_register_btn")
    }
}

export class Register {
    constructor() {
        this.user = document.getElementById("register_user");
        this.password = document.getElementById("register_password");
        this.submitBtn = document.getElementById("register_submit_btn");
        this.backLoginBtn = document.getElementById("register_back_login_btn");
    }
}

export class Header {
    constructor() {
        this.logoutBtn = document.getElementById("logout_btn");
        this.diaryListHomeBtn = document.getElementById("diary_list_home_btn");
        this.notificationTransitionBtn = document.getElementById("notification_register_btn")
        this.dailyDiaryBtn = document.getElementById("daily_diary_btn");
    }
}

export class Notification {
    constructor() {
        this.notification = document.getElementById("notification_address");
        this.notificationRecordBtn = document.getElementById("notification_record_btn");
        this.mailAddressParent = document.getElementById("mailAddressBody");
        this.mailAddressOrigin = document.getElementById("mailAddressList");
        this.notificationSubmitBtn = document.getElementById("notification_submit_btn");
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