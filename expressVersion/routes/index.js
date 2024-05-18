var express = require('express');
var router = express.Router();
const sessionController = require("../app/controllers/sessionController");
const mailController = require("../app/controllers/mailController");

router.get("/daily-report",(req,res)=>{
    res.render("index")
})

//session
router.post("/isSessionCheck", sessionController.apiIsSessionCheck);
router.post("/isExsistCheck", sessionController.apiIsExsistCheck);
router.post("/isLogout", sessionController.apiIsLogout);

//mail
router.post("/isRegisterMailAddress", mailController.isRegisterMailAddress);
router.post("/getUserMailAddress", mailController.getUserMailAddressList);

module.exports = router;
