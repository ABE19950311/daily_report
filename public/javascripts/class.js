export class Login {
    constructor() {
        this.loginBtn = document.getElementById("login_btn");
        this.loginUser = document.getElementById("login_user");
        this.loginPassword = document.getElementById("login_password");
    }
}

export class Register {
    constructor() {
        this.user = document.getElementById("register_user");
        this.password = document.getElementById("register_password");
        this.submitBtn = document.getElementById("register_submit_btn");
    }
}

export class Header {
    constructor() {
        this.logoutBtn = document.getElementById("logout_btn");
    }
}

export class Notification {
    constructor() {
        this.notification = document.getElementById("notification_address");
        this.notificationRecordBtn = document.getElementById("notification_record_btn");
    }
}