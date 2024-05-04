const mysql = require("mysql2/promise");
let mysqlClient;

async function mysqlConnection() {
    mysqlClient = await mysql.createConnection({
        host: "192.168.64.5",
        port: 3306,
        user: "daily",
        password: "daily",
        database: "daily_report"
    })
}

const dbSelect = (async(table,colmun,query)=>{
    await mysqlConnection();
    try {
        const [result,schema] = await mysqlClient.execute(
            `SELECT ${colmun} FROM ${table} ${query}`
        )
        return result
    } catch(error) {
        console.error(error)
        throw error
    } finally {
        await mysqlClient.end()
    }
})

const dbInsert = (async(table,colmun,query)=>{
    await mysqlConnection();
    try {
        const [result,schema] = await mysqlClient.query(
            `INSERT INTO ${table} ${colmun} VALUES(${query})`
        )
        return result
    } catch (error) {
        console.error(error)
        throw error
    } finally {
        await mysqlClient.end()
    }
})

module.exports = {
    dbSelect,
    dbInsert
}