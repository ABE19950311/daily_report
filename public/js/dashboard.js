import * as page from "./class.js";
import * as request from "./request.js";

let dashboard = null

window.addEventListener("DOMContentLoaded",()=>{
    try {
        dashboard = new page.Dashboard()
        main()
    } catch(e) {
        console.error(e)
    }
})

async function main() {
    if(await getReportData()) {
        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart2);
        google.charts.setOnLoadCallback(drawChart3);
        google.charts.setOnLoadCallback(drawChart4);
    }
}

async function getReportData() {
    const url = "https://192.168.64.6/report/json"

    const response = await request.requestToServer(url,"POST");

    if(response && response.status == 200) {
        dashboard.reportList = response.report
        return true
    } else {
        return false
    }
}

function drawChart() {
    var target = document.getElementById("chart");
    var data;
    var options = {
    title: "My Bar Chart",
    width: "500",
    height: "400",
        colors: ["lightskyblue", "lightgreen"],
    animation: {
        startup: true,
        duration: 800,
        easing: "inAndOut"
    }
    //       isStacked:　＝ 積み上げ表示
    // isStacked: true,
    //       percent = 100%表記
    // isStacked: "percent"
    };
    // var chart = new google.visualization.BarChart(target);
    var chart = new google.visualization.ColumnChart(target);
    data = new google.visualization.arrayToDataTable([
    ["Team", "Item-1", "Item-2"],
    ["Team A", 12, 38],
    ["Team B", 42, 18],
    ["Team C", 11, 58]
    ]);
    chart.draw(data, options);
}

function drawChart2() {
    var target = document.getElementById("chart2");
    var data;
    var options = {
    title: "My Line Chart",
    width: "500",
    height: "400",
    animation: {
        startup: true,
        duration: 800,
        easing: "inAndOut"
    },
    hAxis: { title: "Year" },
    vAxis: { title: "Sales" },
    curveType: "function",
    pointSize: 6
    // pointShape: 'square'
    };
    var chart = new google.visualization.LineChart(target);
    // var chart = new google.visualization.ColumnChart(target);
    data = new google.visualization.arrayToDataTable([
    // ["Year", "Bob", "Jane", { role: "certainty" }, "Carry"],
    // ["2017/05", 12, 38, null, 80],
    // ["2017/06", 42, 18, null, 10],
    // ["2017/07", 11, 58, 'Camp A', 130],
    // ["2017/08", 111, 158, null, 70]

    [
        "Year",
        "@アイテムA",
        { role: "annotation" },
        { role: "certainty" },
        "@アイテムB",
        { role: "certainty" }
    ],
    ["2014", 52, "キャンペーン A", true, 89, true],
    ["2015", 38, null, true, 78, true],
    ["2016", 122, "キャンペーン B", true, 88, true],
    ["2017", 62, null, true, 91, true],
    ["2018", 142, "想定売上げ", false, 101, false]
    ]);
    chart.draw(data, options);
}

function drawChart3() {
    var query = new google.visualization.Query(
    "https://docs.google.com/spreadsheets/d/1KB-KcJDvV5dWla7OFnq-ip_HSwogRh-KMfGuPr2-1XQ/edit?usp=sharing"
    );
    query.send(handleQueryResponse);
}

async function handleQueryResponse(response) {
    var target = document.getElementById("chart3");
    var data;
    var options = {
    title: "Program Share",
    width: 500,
    height: 300,
    colors: ["darkgreen", "crimson","mediumblue","olive","yellow","green","purple","orange","black"],
    };
    var chart = new google.visualization.PieChart(target);
    let total = await doTotallingReportData() 
    console.log(total)
    var data = google.visualization.arrayToDataTable([
        ['category', 'totalling Category'],
        ['開発',    total["開発"]],
        ['サーバ',  total["サーバ"]],
        ['ネットワーク',    total["ネットワーク"]],
        ['AWS', total["AWS"]],
        ['コマンドライン',    total["コマンドライン"]],
        ['OS',  total["OS"]],
        ['ミドルウェア',    total["ミドルウェア"]],
        ['エラー対応',  total["エラー対応"]],
        ['その他',  total["その他"]]
      ]);
    chart.draw(data, options);
}

async function doTotallingReportData() {
    let total = {
        "開発":0,
        "サーバ":0,
        "ネットワーク":0,
        "AWS":0,
        "コマンドライン":0,
        "OS":0,
        "ミドルウェア":0,
        "エラー対応":0,
        "その他":0
    }
    Object.entries(dashboard.reportList).forEach((data)=>{
        total[data[1]["category"]] = total[data[1]["category"]]+1
    })
    return total
}
  
function drawChart4() {
    var target = document.getElementById("chart4");
    var data;
    var options = {
    title: "My Bar Chart",
    width: "500",
    height: "400",
    animation: {
        startup: true,
        duration: 800,
        easing: "inAndOut"
    }
    //       isStacked:　＝ 積み上げ表示
    // isStacked: true,
    //       percent = 100%表記
    // isStacked: "percent"
    };
    var chart = new google.visualization.BarChart(target);
    // var chart = new google.visualization.ColumnChart(target);
    data = new google.visualization.arrayToDataTable([
    ["Team", "Item-1", "Item-2"],
    ["Team A", 12, 38],
    ["Team B", 42, 18],
    ["Team C", 11, 58]
    ]);
    chart.draw(data, options);
}
