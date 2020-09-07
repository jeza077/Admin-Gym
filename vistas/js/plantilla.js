/*=============================================
    INPUT MASK
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

/*=============================================
    SIDEBAR MENU ACTIVO COLOR AZUL
=============================================*/
// const linkColor = $('.menu-lateral');
// const linkColor = document.querySelectorAll('.menu-lateral');
const claseActivo = $('.menu-lateral');

var pathname = window.location.href;
console.log(pathname)

var result = $(claseActivo);
// console.log(result[3]);
var stock = result[3];

for (let i = 0; i < result.length -1; i++) {
    // console.log(result[i]['href']);
    if(pathname == result[i]['href']){
        // console.log(result[i]['href'])
        $(result[i]).addClass('active');     
        break;
    }
    if(pathname == 'http://localhost/gym/equipo' || pathname == 'http://localhost/gym/productos'){
        $(stock).addClass('active')
    }
}



// function colorLink(){
//     linkColor.forEach(l => l.classList.remove('active'));
//     this.classList.add('active');
// }
// const link = linkColor.forEach(l => l.addEventListener('click', colorLink));
