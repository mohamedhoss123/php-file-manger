const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const theID = urlParams.get('id')
console.log(theID)
document.querySelectorAll("#folder").forEach(ele => {
    ele.addEventListener("click", () => {
        window.sessionStorage.setItem("id", ele.getAttribute("data-id"))
    })
})
document.getElementById("new-folder").addEventListener("click", function () {
    let name = document.getElementById("inp").value
    //console.log(name)
    const xhr = new XMLHttpRequest();
    xhr.onload = function(){
        console.log(this.responseText)
    }
    xhr.open("POST","./api.php")
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    xhr.send(`type=folder&folder-name=${name}&folder-id=${theID}`)
    location.reload();
})
