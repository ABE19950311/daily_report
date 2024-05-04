const mysql = require("../models/mysql");
const response = require("./responseController");
const express = require('express');
const bodyParser = require("body-parser");
const app = express();

app.use(bodyParser.json());

const apiIsRegisterUser = (async(req,res)=>{
    // await mysqlConnection();
    // const [result,filelds] = await mysqlClient.query(
    //     `INSERT INTO account (user,password) VALUES("${requestBody["user"]}","${requestBody["password"]}")`
    // )
    // await mysqlClient.end()
    const result = await mysql.dbInsert("account","(user,password)",`"${req["body"]["user"]}","${req["body"]["password"]}"`);
    console.log(result)
    const responseBody = {
        applicationStatusCode: "Success",
        applicationMessage: "Success"
    }
    response.doResponse(res,200,RESPONSE_HEADER,responseBody);
})

module.exports = {
    apiIsRegisterUser
}