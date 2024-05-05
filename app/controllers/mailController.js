const mysql = require("../models/mysql");
const redis = require("../models/redis");
const response = require("./responseController");
const express = require("express");
const cookieParser = require("cookie-parser");
const bodyParser = require("body-parser");
const app = express();

app.use(bodyParser.json())
app.use(cookieParser())

const RESPONSE_HEADER = {
    "Content-Type": "application/json",
    "Access-Control-Allow-Origin": "*"
}

async function getSessionUserIdFromCookie(req) {
    const sessionToken = req.cookies.sessionToken
    if(!sessionToken) return ""
    const user = await redis.getSessionToken(sessionToken)
    const id = await mysql.dbSelect("account","id",`where user="${user}"`)
    return id
}

const isRegisterMailAddress = (async(req,res)=>{
    const mailAddress = req["body"]["mailAddress"]
    const userId = await getSessionUserIdFromCookie(req)
    if(!userId) {
        response.responseProblemSessiionToken(res,"SessionUserId does not exist")
        return
    }
    await mysql.dbInsert("notification","(address,account_id)",`"${mailAddress}",${userId[0]}`)
    const responseBody = {
        applicationStatusCode: "Success",
        applicationMessage: "Success"
    }
    response.doResponse(res,200,RESPONSE_HEADER,responseBody);
})

const getUserMailAddressList = (async(req,res)=>{
    const userId = await getSessionUserIdFromCookie(req);
    if(!userId) {
        response.responseProblemSessiionToken(res,"SessionUserId does not exist")
        return
    }
    const mailAddressList = await mysql.dbSelect("notification","address",`WHERE account_id="${userId[0]}"`)
    console.log(mailAddressList)
    const responseBody = {
        applicationStatusCode: "Success",
        applicationMessage: "Success",
        mailAddressList: mailAddressList
    }
    response.doResponse(res,200,RESPONSE_HEADER,responseBody)
})


module.exports = {
    isRegisterMailAddress,
    getUserMailAddressList
}