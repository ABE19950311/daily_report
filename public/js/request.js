export async function requestToServer(url,method,body) {
    const option = {
        method: method,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(body).toString()
    }
    try {
        const res = await fetch(url,option)
        const data = await res.json()
        console.log(data)
        return data
    } catch(e) {
        console.error(e)
        throw e
    }
}