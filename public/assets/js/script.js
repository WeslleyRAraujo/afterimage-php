const button = document.getElementById("send-message")
button.addEventListener('click', () => {
    let message = document.getElementById("input-pretty").value
    if(!message.length === 0 || message.trim()) {
        window.location.href= window.location.href + `message/${message}`
    }
})