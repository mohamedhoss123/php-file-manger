const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const theID = urlParams.get('id')
console.log(theID)

document.querySelectorAll("#folder-del-btn").forEach(ele => {
    ele.addEventListener("click", () => {
        const xhr = new XMLHttpRequest();
        xhr.onload = function () {
            console.log(this.responseText)
            let res = JSON.parse(this.responseText)
            if (res['type'] == "folder" && res["action"] == "delet") {
                setInterval(location.reload(), 50)
                // console.log(res["files"])
            }
        }
        xhr.open("POST", "./api.php")
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xhr.send(`type=folder&folder-id=${ele.getAttribute("data-id")}&action=delet`)

    })
})

document.querySelectorAll("#folder").forEach(ele => {
    ele.addEventListener("click", () => {
        window.sessionStorage.setItem("id", ele.getAttribute("data-id"))
    })
})

document.querySelectorAll("#file-del-btn").forEach(ele => {
    ele.addEventListener("click", () => {
        const xhr = new XMLHttpRequest();
        xhr.onload = function () {
            let res = JSON.parse(this.responseText)
            if (res['type'] == "file" && res["action"] == "delet") {
                setInterval(location.reload(), 50)
                console.log(res["status"])
            }
        }
        xhr.open("POST", "./api.php")
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        let href = document.getElementById(ele.getAttribute("data-id")).getAttribute("href")
        xhr.send(`type=file&file-id=${ele.getAttribute("data-id")}&action=delet&path=${href}`)
    })
})


document.getElementById("new-folder").addEventListener("click", function () {
    let name = document.getElementById("inp").value
    //console.log(name)
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        console.log(this.responseText)
        let res = JSON.parse(this.responseText)
        if (res['status'] == "create" && res["type"] == "folder") {
            setInterval(location.reload(), 50)
        }
    }
    xhr.open("POST", "./api.php")
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.send(`type=folder&folder-name=${name}&folder-id=${theID}&action=create`)
})

document.getElementById("add-file-button").addEventListener("click", upload)
async function upload() {
    var file = document.getElementById('file').files[0];
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("parent", theID)
    var ajax_request = new XMLHttpRequest()
    ajax_request.open("POST","./upload.php")
    ajax_request.upload.addEventListener("progress",function(event){
        var presetnt_copleted = Math.round((event.loaded/event.total)*100)
        document.getElementById("progress").innerText = presetnt_copleted + "%"
    })
    ajax_request.addEventListener("load",function(event){
        location.reload()
    })
    ajax_request.send(formdata)
}