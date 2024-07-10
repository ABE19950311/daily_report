import * as page from "./class.js";
import * as request from "./request.js";

let home = null;
let header = null;
let report = null;

window.addEventListener("DOMContentLoaded",()=>{
    try {
        home = new page.Home();
        header = new page.Header();
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

//TODO
//検索機能formにする
//categoryとタイトル検索欄２つ用意する、ボタンは両方共有で１個
//page番号はフロントから渡した番号をbladeに埋め込んでおく
//検索時に埋め込んだ番号も渡す

function initialEvents() {
    if(header.diaryListHomeBtn) header.diaryListHomeBtn.addEventListener("click",loadHomePage);

    if(report.previousBtn) report.previousBtn.addEventListener("click", {flag:"previous",page:null,handleEvent:updateCurrentPage})
    if(report.nextBtn) report.nextBtn.addEventListener("click", {flag:"next",page:null,handleEvent:updateCurrentPage})

    //smartyで作成したreportListをquerySelectorAll使って配列でdom要素受け取る
    //forEachで取得要素にevent付与してく
    
    if(report.pagenationBtn.length) {
        report.pagenationBtn.forEach((elm)=>{
            elm.addEventListener("click",{flag:null,page:elm.value,handleEvent:updateCurrentPage})
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
    if(home.titleSearchVal) {
        home.titleSearchVal = home.titleSearch.value
    }
}

function initialCategorySearchValue() {
    if(home.categorySearch) {
        const categoryIndex = home.categorySearch.selectedIndex
        const category = home.categorySearch.options[categoryIndex].value
        home.categorySearchVal = category
    }
}

async function loadHomePage() {
    const page = report.currentPage ? report.currentPage : 1
    const titleSearch = home.titleSearchVal ? home.titleSearchVal : ""
    const categorySearch = home.categorySearchVal ? home.categorySearchVal : ""
    
    const params = {
            titleSearch:titleSearch,
            categorySearch:categorySearch
        }
    const query = new URLSearchParams(params).toString()
    const url = `https://192.168.64.6/home/${page}?${query}`

    try {
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