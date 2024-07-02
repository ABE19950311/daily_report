export async function requestToServer(url,method,body={}) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content

    const option = {
        method: method,
        headers: {
            'X-CSRF-TOKEN': csrf,
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(body).toString()
    }

    try {
        const res = await fetch(url,option)
        //const data = await res.json()
        console.log(res)
        return res
    } catch(e) {
        throw new Error(e)
    }
}