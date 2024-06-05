export async function requestToServer(url,method,body={}) {
    let option = {}

    if(method=="GET") {
        option = {
            method: "GET",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }
    } else {
        option = {
            method: method,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams(body).toString()
        }
    }

    try {
        const res = await fetch(url,option)
        const data = await res.json()
        console.log(data)
        return data
    } catch(e) {
        throw new Error(e)
    }
}

export async function requestPageToServer(url,method,body={}) {
    let option = {}

    if(method=="GET") {
        option = {
            method: "GET",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }
    } else {
        option = {
            method: method,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams(body).toString()
        }
    }

    try {
        await fetch(url,option)
    } catch(e) {
        throw new Error(e)
    }
}