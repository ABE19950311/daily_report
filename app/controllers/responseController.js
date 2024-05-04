const RESPONSE_HEADER = {
    "Content-Type": "application/json",
    "Access-Control-Allow-Origin": "*"
}

const doResponse = ((res,httpStatusCode,responseHeader,responseBody)=>{
    res.status(httpStatusCode);
    res.header(responseHeader);
    res.send(JSON.stringify(responseBody)+"\n");
})

const responseProblemSessiionToken = ((res, applicationMessage)=>{
    doResponse(res,200,RESPONSE_HEADER,{
        applicationStatusCode:"problem_process",
        applicationMessage: applicationMessage
    })
})

module.exports = {
    doResponse,
    responseProblemSessiionToken
}