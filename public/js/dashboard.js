import * as page from "./class.js";

window.addEventListener("DOMContentLoaded",()=>{
    main()
})

function main() {
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChart2);
    google.charts.setOnLoadCallback(drawChart3);
    google.charts.setOnLoadCallback(drawChart4);
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

function handleQueryResponse(response) {
    var target = document.getElementById("chart3");
    var data;
    var options = {
    title: "Program Share",
    width: 500,
    height: 300,
    colors: ["darkgreen", "crimson","mediumblue","olive"],
    };
    var chart = new google.visualization.PieChart(target);
    data = response.getDataTable();
    chart.draw(data, options);
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
