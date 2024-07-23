export class Header {
    constructor() {
        this.diaryListHomeBtn = document.getElementById("diary_list_home_btn")
    }
}

export class Report {
    constructor() {
        this.previousBtn = document.getElementById("pagenation_previous")
        this.nextBtn = document.getElementById("pagenation_next")
        this.pagenationBtn = document.querySelectorAll(".pagenation-item")
        this.currentPage = null;
    }

    set currentPage(value) {
        this._currentPage = value;
    }
    get currentPage() {
        return this._currentPage;
    }
}

export class Home {
    constructor() {
        this.categorySearchBtn = document.getElementById("category_search_btn")
        this.categorySearch = document.getElementById("category_search")
        this.titleSearchBtn = document.getElementById("title_search_btn")
        this.titleSearch = document.getElementById("title_search")
        this.titleSearchVal = null
        this.categorySearchVal = null
    }

    set titleSearchVal(value) {
        this._titleSearchVal = value
    }
    get titleSearchVal() {
        return this._titleSearchVal
    }

    set categorySearchVal(value) {
        this._categorySearchVal = value
    }
    get categorySearchVal() {
        return this._categorySearchVal
    }
}

export class Dashboard {
    constructor() {
        this.reportList = null
    }

    set reportList(value) {
        this._reportList = value
    }
    get reportList() {
        return this._reportList
    }
}