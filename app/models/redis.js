const redis = require("ioredis");
let redisClient;

async function redisConnection() {
    redisClient = await new redis({
        host: "192.168.64.5",
        port: 6379,
        db: 0
    })
}

const setSessionToken = (async(token,user)=>{
    await redisConnection()
    try {
        await redisClient.set(`${token}`,`${user}`)
    } catch (error) {
        console.error(error)
        throw new Error
    } finally {
        await redisClient.quit()
    }
})

const getSessionToken = (async(token)=>{
    await redisConnection()
    try {
        const result = await redisClient.get(`${token}`)
        return result
    } catch (error) {
        console.error(error)
        throw new Error
    } finally {
        await redisClient.quit()
    }
})

const deleteSessionToken = (async(token)=>{
    await redisConnection()
    try {
        await redisClient.del(`${token}`)
    } catch (error) {
        console.error(error)
        throw new Error
    } finally {
        await redisClient.quit()
    }
})

module.exports = {
    setSessionToken,
    getSessionToken,
    deleteSessionToken
}