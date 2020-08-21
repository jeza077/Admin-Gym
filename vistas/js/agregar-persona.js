function toggleUser(){
    var container = document.querySelector('.card');
    container.classList.toggle('active');
}

$("#btnSiguiente").click(function(event){  
    event.prevenDefault();
})