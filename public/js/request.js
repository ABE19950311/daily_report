export async function requestToServer(url,method,body={}) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content
    let option = {}

    if(method=="GET") {
        option = {
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': csrf,
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }
    } else {
        option = {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf,
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
    const csrf = document.querySelector('meta[name="csrf-token"]').content
    let option = {}

    if(method=="GET") {
        option = {
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': csrf,
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }
    } else {
        option = {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf,
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams(body).toString()
        }
    }

    try {
        const res = await fetch(url,option)
        console.log(res)
        return res
    } catch(e) {
        throw new Error(e)
    }
}