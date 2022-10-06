window.onload = function() {
    let myInputElement = document.querySelector(`#myName`);

    if (myInputElement) {

    myInputElement.addEventListener('keyup', function(event) {
        let myTextElement = document.querySelector(`#outputName`);
        myTextElement.innerText = myInputElement.value;
    });
    }
}