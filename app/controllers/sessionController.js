const redis = require("../models/redis");
const mysql = require("../models/mysql");
const response = require("./responseController");
const express = require('express');
const cookieParser = require("cookie-parser");
const bodyParser = require("body-parser");
const app = express();
const Crypto = require("crypto");

app.use(cookieParser());
app.use(bodyParser.json());

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

const apiIsSessionCheck = (async (req,res)=>{
    const sessionUserId = await getSessionUserIdFromCookie(req)
    if(!sessionUserId) {
        response.responseProblemSessiionToken(res,"SessionUserId does not exist")
        return
    }
    console.log(sessionUserId[0])
    const responseBody = {
        applicationStatusCode: "Success",
        applicationMessage: "Success"
    }
    response.doResponse(res,200,RESPONSE_HEADER,responseBody);
})

const apiIsExsistCheck = (async(req,res)=>{
    const result = await mysql.dbSelect("account","user,password",`WHERE user="${req["body"]["loginUser"]}" AND password="${req["body"]["loginPassword"]}"`);
    if(!result.length) {
        response.responseProblemSessiionToken(res,"User does not exist")
        return
    }
    const sessionToken = `sessionToken-${getRandomId()}`
    await redis.setSessionToken(sessionToken,req["body"]["loginUser"])
    const responseHeader = RESPONSE_HEADER
    responseHeader["Set-Cookie"] = `sessionToken=${sessionToken}`
    const responseBody = {
        applicationStatusCode: "Success",
        applicationMessage: "Success"
    }
    response.doResponse(res,200,responseHeader,responseBody);
})

function getRandomId() {
    const func = function() { return Crypto.randomBytes(16).toString("base64").replace(/\W/g, '').substring(0, 16);}
    const id = func()
    while (id.length<16) {id=func()}
    return id;
}

const apiIsLogout = (async(req,res)=>{
    const sessionToken = req.cookies.sessionToken
    if(!sessionToken) {
        response.responseProblemSessiionToken(res,"Session does not exist")
        return
    }
    await redis.deleteSessionToken(sessionToken)
    const delCheck = await redis.getSessionToken(sessionToken)
    console.log(delCheck)
    if(delCheck!=null) {
        response.responseProblemSessiionToken(res,"Session does exist")
        return
    }
    const responseBody = {
        applicationStatusCode: "Success",
        applicationMessage: "Success"
    }
    response.doResponse(res,200,RESPONSE_HEADER,responseBody);
})

module.exports = {
    apiIsSessionCheck,
    apiIsExsistCheck,
    apiIsLogout
}