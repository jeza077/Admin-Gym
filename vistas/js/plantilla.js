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

var pathname = window.location.href;
const claseActivo = $('.menu-lateral');
// console.log(claseActivo[3]);
var stock = claseActivo[3];

for (let i = 0; i < claseActivo.length -1; i++) {
    // console.log(claseActivo[i]['href']);
    if(pathname == claseActivo[i]['href']){
        $(claseActivo[i]).addClass('active');     
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
