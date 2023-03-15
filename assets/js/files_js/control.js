$('#datepicker').datepicker({
    format: "dd/mm/yyyy",
    weekStart: 0,
    language: "es",
    autoclose: true,
    daysOfWeekDisabled: "0",
    todayHighlight: true
});

$.fn.select2.defaults.set('language', 'es');
$('#nombres').select2();
$('#empleado').select2();


const labels = document.querySelector("#col-uno");
const label_rec = ['Cabecera', 'Tocador', 'Buro', 'Luna'];
const label_buro = ['Buro'];
const label_litera = ['CajonChica','CajonGrande'];
const label_comedor = ['Pedestal','Cubierta','Bufetera','Trinchador'];
const label_cajonera = ['Cajonera'];

const label_jgo = ['Mesa','Lateral','Lateral'];

const names = document.querySelector('#nombres');

document.addEventListener('DOMContentLoaded', function (e) {
    cargarProducto('corte');
    loadCol('corte');
    areaClick = 'corte';
    tablePreRep = $('#tableUser').DataTable({
        language: {
            url: 'assets/js/spanish/Spanish.json'
        },
        "ajax": {
            "url": " "+ base_url+'control/getReports',
            "dataSrc": ""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"fecha"},
            {"data":"area"},
            {"data":"producto"},
            {"data":"descripcion"},
            {"data":"puntos"},
            {"data":"porcentaje"}
            // {"data":"acciones"}
        ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLegth": 5,
        "order": [[0, "asc"]]
        });


});

function cargarProducto(area)
{
    /**
         * cargar productos por areas
         */
    document.querySelector("#totalPunto").value = 0;
    document.querySelector("#totalPorcentaje").value = 0;
    var producto = document.querySelector('#nombres').value;
    labels.innerHTML = "";
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'control/getProductos/'+area;
    request.open('GET', ajaxUrl, true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            
            var objReq = JSON.parse(request.responseText);       
            objReq.forEach(element => {
                const option = document.createElement('option');
                option.value = element.producto;
                option.text = element.producto;
                names.appendChild(option);
            });
            
        }
    }
}

var arrayAssoc=[];
// var arrayAssoc2=[];
function loadCol(area)
{
    var requestCol = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxCol = base_url+'control/getCol/'+area;
    requestCol.open('GET', ajaxCol, true);
    requestCol.send();
    requestCol.onreadystatechange = function(){
        if(requestCol.readyState == 4 && requestCol.status == 200){
            // console.log(requestCol.responseText);
            var objCol = JSON.parse(requestCol.responseText);
            var lbl1=0;
            var x = (area!='frentes_cajones') ? 3 : 4;
            console.log(x);
            for(let i=x;i<objCol.length - 3 ;i++){
                arrayAssoc.push({[objCol[i][0]]:label_rec[lbl1]});
                lbl1++;
            }
        }
    }

}

function change_prod()
{
    
    loadCol(areaClick);
    /*var l='cabecera';
    var k=l.toString();
    console.log(k);
    const names = arrayAssoc.map(function(name, index){
        return {
            [label_rec.toString()] : name.dato
        }
    });*/

    console.log(arrayAssoc);
    
    document.querySelector("#totalPunto").value = 0;
    document.querySelector("#totalPorcentaje").value = 0;

    var producto = document.querySelector('#nombres').value;
    var inputs = '';
    var subProduct = producto.split(' ');
    console.log(subProduct);
    console.log(subProduct[0]);
    console.log(subProduct[1]);

if(areaClick != 'frentes_cajones'){

    switch(subProduct[0]) {

        case 'REC':
            for(var i = 0;i < label_rec.length; i++){
                inputs += 
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+label_rec[i].toLowerCase()+'" class="lbls">'+label_rec[i]+'</label>'+
                '<input type="text" name="'+label_rec[i].toLowerCase()+'" id="'+label_rec[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_rec[i]+'" id="puntos'+label_rec[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_rec[i]+'" id="porcentaje'+label_rec[i]+'" class="form-control por" disabled>'+
                '</div>';
              }
        break;

        case 'BURO':
            for(var i = 0;i < label_buro.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+label_buro[i].toLowerCase()+'" class="lbls">'+label_buro[i]+'</label>'+
                '<input type="text" name="'+label_buro[i].toLowerCase()+'" id="'+label_buro[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_buro[i]+'" id="puntos'+label_buro[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_buro[i]+'" id="porcentaje'+label_buro[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'LITERA':
            for(var i = 0;i < label_litera.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre" >'+
                '<label for="'+label_litera[i].toLowerCase()+'" class="lbls">'+label_litera[i]+'</label>'+
                '<input type="text" name="'+label_litera[i].toLowerCase()+'" id="'+label_litera[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_litera[i]+'" id="puntos'+label_litera[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_litera[i]+'" id="porcentaje'+label_litera[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'COMEDOR':
            
            var pzs = 0;
            if (subProduct[1] == 'EMPERADOR'){
                pzs = 4;
            }else if(subProduct[1] == 'ARY' || subProduct[1] == 'NATALY' || subProduct[1] == 'TULUM'){
                pzs = 1;
            }
            else{
                pzs = 2;
            }
            
            for(var i = 0;i < pzs; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<div class="cantidad"><label for="'+label_comedor[i].toLowerCase()+'" class="lbls">'+label_comedor[i]+'</label></div>'+
                '<input type="text" name="'+label_comedor[i].toLowerCase()+'" id="'+label_comedor[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_comedor[i]+'" id="puntos'+label_comedor[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_comedor[i]+'" id="porcentaje'+label_comedor[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'CAJONERA':
            // for(var i = 0;i < label_cajonera.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="cajonera" class="lbls">Cajonera</label>'+
                '<input type="text" name="cajonera" id="cajonera" class="form-control por">'+
                '<input type="text" name="puntosCajonera" id="puntosCajonera" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeCajonera" id="porcentajeCajonera" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'CENTRO':
            // for(var i = 0;i < label_centro.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="centro" class="lbls">Centro</label>'+
                '<input type="text" name="centro" id="centro" class="form-control por">'+
                '<input type="text" name="puntosCentro" id="puntosCentro" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeCentro" id="porcentajeCentro" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'BUFETERA':
            // for(var i = 0;i < label_centro.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="bufetera" class="lbls">Bufetera</label>'+
                '<input type="text" name="bufetera" id="bufetera" class="form-control por">'+
                '<input type="text" name="puntosBufetera" id="puntosBufetera" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeBufetera" id="porcentajeBufetera" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'JGO':
            for(var i = 0;i < label_jgo.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+label_jgo[i].toLowerCase()+'" class="lbls">'+label_jgo[i]+'</label>'+
                '<input type="text" name="'+label_jgo[i].toLowerCase()+'" id="'+label_jgo[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_jgo[i]+'" id="puntos'+label_jgo[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_jgo[i]+'" id="porcentaje'+label_jgo[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'MESA':
            var pzs = (subProduct[3]=='TOSCANO') ? 3 : 1;

            for(var i = 0;i < pzs; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+label_jgo[i].toLowerCase()+'" class="lbls">'+label_jgo[i]+'</label>'+
                '<input type="text" name="'+label_jgo[i].toLowerCase()+'" id="'+label_jgo[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_jgo[i]+'" id="puntos'+label_jgo[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_jgo[i]+'" id="porcentaje'+label_jgo[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'TORRE':
            case 'SEPARADOR':
            var sp = subProduct[0] =='TORRE' ? 'Torre' : 'Separador';
            // for(var i = 0;i < pzs; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="torre" class="lbls">'+sp+'</label>'+
                '<input type="text" name=torre" id="torre" class="form-control por">'+
                '<input type="text" name="puntos'+sp+'" id="puntos'+sp+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+sp+'" id="porcentaje'+sp+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'ARMARIO':
            var sub = subProduct[2] =='MONICA' ? 'Armario' : 'Armario';
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="armario" class="lbls">'+sub+'</label>'+
                '<input type="text" name="armario" id="armario" class="form-control por">'+
                '<input type="text" name="puntos'+sub+'" id="puntos'+sub+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+sub+'" id="porcentaje'+sub+'" class="form-control por" disabled>'+
                '</div>';
        break;

        case 'BAR':
            // var sub = subProduct[2] =='MONICA' ? 'Armario' : 'Armario';
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="bar" class="lbls">Bar</label>'+
                '<input type="text" name="bar" id="bar" class="form-control por">'+
                '<input type="text" name="puntosBar" id="puntosBar" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeBar" id="porcentajeBar" class="form-control por" disabled>'+
                '</div>';
        break;

        default:
        inputs = '';
        break;

    }

}
else{

    var lbl_re={"col_uno":"Frentes","col_dos":"Cajones","col_tres":"Puertas","col_cuatro":"Resplado","col_cinco":"Barrote"};
    switch(subProduct[0]) {

        case 'REC':
            case 'LITERA':
            for(var i = 0;i < lbl_re.length; i++){
                inputs += 
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+lbl_re[i].toLowerCase()+'" class="lbls">'+lbl_re[i]+'</label>'+
                '<input type="text" name="'+lbl_re[i].toLowerCase()+'" id="'+lbl_re[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+lbl_re[i]+'" id="puntos'+lbl_re[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+lbl_re[i]+'" id="porcentaje'+lbl_re[i]+'" class="form-control por" disabled>'+
                '</div>';
              }
        break;

        // case 'BURO':
        //     for(var i = 0;i < label_buro.length; i++){
        //         inputs +=
        //         '<div class="form-group grid-in" name="padre" id="padre">'+
        //         '<label for="'+label_buro[i].toLowerCase()+'" class="lbls">'+label_buro[i]+'</label>'+
        //         '<input type="text" name="'+label_buro[i].toLowerCase()+'" id="'+label_buro[i].toLowerCase()+'" class="form-control por">'+
        //         '<input type="text" name="puntos'+label_buro[i]+'" id="puntos'+label_buro[i]+'" class="form-control por" disabled>'+
        //         '<input type="text" name="porcentaje'+label_buro[i]+'" id="porcentaje'+label_buro[i]+'" class="form-control por" disabled>'+
        //         '</div>';
        //       }
        // break;

        // case 'LITERA':
        //     for(var i = 0;i < label_litera.length; i++){
        //         inputs += 
        //         '<div class="form-group grid-in" name="padre" id="padre" >'+
        //         '<label for="'+label_litera[i].toLowerCase()+'" class="lbls">'+label_litera[i]+'</label>'+
        //         '<input type="text" name="'+label_litera[i].toLowerCase()+'" id="'+label_litera[i].toLowerCase()+'" class="form-control por">'+
        //         '<input type="text" name="puntos'+label_litera[i]+'" id="puntos'+label_litera[i]+'" class="form-control por" disabled>'+
        //         '<input type="text" name="porcentaje'+label_litera[i]+'" id="porcentaje'+label_litera[i]+'" class="form-control por" disabled>'+
        //         '</div>';
        //       }
        // break;

        case 'COMEDOR':
            
            var pzs = 0;
            if (subProduct[1] == 'EMPERADOR'){
                pzs = 4;
            }else if(subProduct[1] == 'ARY' || subProduct[1] == 'NATALY' || subProduct[1] == 'TULUM'){
                pzs = 1;
            }
            else{
                pzs = 2;
            }
            
            for(var i = 0;i < pzs; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<div class="cantidad"><label for="'+label_comedor[i].toLowerCase()+'" class="lbls">'+label_comedor[i]+'</label></div>'+
                '<input type="text" name="'+label_comedor[i].toLowerCase()+'" id="'+label_comedor[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_comedor[i]+'" id="puntos'+label_comedor[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_comedor[i]+'" id="porcentaje'+label_comedor[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'CAJONERA':
            // for(var i = 0;i < label_cajonera.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="cajonera" class="lbls">Cajonera</label>'+
                '<input type="text" name="cajonera" id="cajonera" class="form-control por">'+
                '<input type="text" name="puntosCajonera" id="puntosCajonera" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeCajonera" id="porcentajeCajonera" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'CENTRO':
            // for(var i = 0;i < label_centro.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="centro" class="lbls">Centro</label>'+
                '<input type="text" name="centro" id="centro" class="form-control por">'+
                '<input type="text" name="puntosCentro" id="puntosCentro" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeCentro" id="porcentajeCentro" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'BUFETERA':
            // for(var i = 0;i < label_centro.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="bufetera" class="lbls">Bufetera</label>'+
                '<input type="text" name="bufetera" id="bufetera" class="form-control por">'+
                '<input type="text" name="puntosBufetera" id="puntosBufetera" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeBufetera" id="porcentajeBufetera" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'JGO':
            for(var i = 0;i < label_jgo.length; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+label_jgo[i].toLowerCase()+'" class="lbls">'+label_jgo[i]+'</label>'+
                '<input type="text" name="'+label_jgo[i].toLowerCase()+'" id="'+label_jgo[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_jgo[i]+'" id="puntos'+label_jgo[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_jgo[i]+'" id="porcentaje'+label_jgo[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'MESA':
            var pzs = (subProduct[3]=='TOSCANO') ? 3 : 1;

            for(var i = 0;i < pzs; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="'+label_jgo[i].toLowerCase()+'" class="lbls">'+label_jgo[i]+'</label>'+
                '<input type="text" name="'+label_jgo[i].toLowerCase()+'" id="'+label_jgo[i].toLowerCase()+'" class="form-control por">'+
                '<input type="text" name="puntos'+label_jgo[i]+'" id="puntos'+label_jgo[i]+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+label_jgo[i]+'" id="porcentaje'+label_jgo[i]+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
              }
        break;

        case 'TORRE':
            case 'SEPARADOR':
            var sp = subProduct[0] =='TORRE' ? 'Torre' : 'Separador';
            // for(var i = 0;i < pzs; i++){
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="torre" class="lbls">'+sp+'</label>'+
                '<input type="text" name=torre" id="torre" class="form-control por">'+
                '<input type="text" name="puntos'+sp+'" id="puntos'+sp+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+sp+'" id="porcentaje'+sp+'" class="form-control por" disabled>'+
                //'</div>'+
                '</div>';
            //   }
        break;

        case 'ARMARIO':
            var sub = subProduct[2] =='MONICA' ? 'Armario' : 'Armario';
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="armario" class="lbls">'+sub+'</label>'+
                '<input type="text" name="armario" id="armario" class="form-control por">'+
                '<input type="text" name="puntos'+sub+'" id="puntos'+sub+'" class="form-control por" disabled>'+
                '<input type="text" name="porcentaje'+sub+'" id="porcentaje'+sub+'" class="form-control por" disabled>'+
                '</div>';
        break;

        case 'BAR':
            // var sub = subProduct[2] =='MONICA' ? 'Armario' : 'Armario';
                inputs += //'<div class="fila-uno">'+
                '<div class="form-group grid-in" name="padre" id="padre">'+
                '<label for="bar" class="lbls">Bar</label>'+
                '<input type="text" name="bar" id="bar" class="form-control por">'+
                '<input type="text" name="puntosBar" id="puntosBar" class="form-control por" disabled>'+
                '<input type="text" name="porcentajeBar" id="porcentajeBar" class="form-control por" disabled>'+
                '</div>';
        break;

        default:
        inputs = '';
        break;

    }

}

    
    

    labels.innerHTML = inputs;
    arrayAssoc=[];
}

/**
 * Agregar clase active
 */

    /*$(document).on('click', 'ul li', function(){
        $(this).addClass('active').siblings().removeClass('active');
    });*/
var links = document.querySelectorAll('.areas li');
let areaClick;
links.forEach(li =>{
    li.addEventListener('click',()=>{
        resetLinks();
        li.classList.add('active');
        // console.log('click '+ li.getAttribute('id'));
        $("#nombres").empty();
        cargarProducto(li.getAttribute('id'));
        $("#nombres").empty().append('<option selected disabled value="0">Seleccione una opcion...</option>');
        areaClick = li.getAttribute('id')
        
    });
});

function resetLinks(){
    links.forEach(li =>{
        li.classList.remove('active');
    });
}


/*      END clase active       */


let areaSelec;
document.querySelector("#btnCalcular").addEventListener('click', ()=>{
    // var areaSelec;
    links.forEach(li =>{
        var hasClase2 = li.classList.contains( 'active' );
        if(hasClase2){
            // console.log(li.getAttribute('id'));
            areaSelec = li.getAttribute('id');
        }
    });

    /**
     * obtener nuemo de personas y capacidad
     */
    var selectedEmp = $('#empleado').select2("data");
    var capacidadArea = document.querySelector("#capacidad").value;
        /*for (var i = 0; i <= selectedEmp.length-1; i++) {
            console.log(selectedEmp[i].text);
        }*/
    // console.log(document.querySelector("#capacidad").value);
    var nEmpleados = capacidadArea ==1 ? 1 : selectedEmp.length;
    // console.log(nEmpleados);

    var html = document.querySelectorAll('#padre');
    
    // var area = 'corte';
    var selectProd = document.querySelector('#nombres').value;
    
    var requestElemt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft:XMLHTTP");
    var urlElemet = base_url+'control/getProducto';
    var datos = 'producto='+selectProd+'&area='+areaSelec;
    requestElemt.open('POST', urlElemet, true);
    requestElemt.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    requestElemt.send(datos);
    requestElemt.onreadystatechange = function () {
        if(requestElemt.readyState == 4 && requestElemt.status == 200) {
            // console.log(requestElemt.responseText);
            var objElem = JSON.parse(requestElemt.responseText);
            // console.log(objElem);
            // var sizeHtml = html.length;
            // var nodelist = html.childNodes;
           
           var col=0;
           var arr = ['uno','dos','tres','cuatro'];
           var colum;

            for(let i of  html){
                colum = 'col_'+arr[col];
                    i.children.item(2).value = (i.children.item(1).name == 'buro' ? ((i.children.item(1).value/2) * objElem.data[0][colum]) / nEmpleados : (i.children.item(1).value * objElem.data[0][colum]) / nEmpleados).toFixed(1);
                    i.children.item(3).value = ((i.children.item(2).value * 100) / ((objElem.data[0]['capacidad'] * objElem.data[0]['puntos']) / capacidadArea)).toFixed(3);
                col++;
                
            }

            var totalPuntos=0;
            var totalPorcentaje=0;
            for(let j of html){
                totalPuntos = parseFloat(totalPuntos) + parseFloat(j.children.item(2).value);
                totalPorcentaje = parseFloat(totalPorcentaje) + parseFloat(j.children.item(3).value);
                // console.log(j.children.item(2).value);
            }            
            document.querySelector("#totalPunto").value = totalPuntos;
            document.querySelector("#totalPorcentaje").value = totalPorcentaje;
            // console.log('Total ' + total);
        }

    }


// var selected = $('#empleado').find(':selected').text();
// console.log(selected);



});

/**
 * Guardar Datos Calculados
 */
    
document.querySelector('#btnSave').addEventListener('click', function(){
    // console.log('click '+ this.getAttribute('id'));
    var fecha = document.querySelector("#datepicker").value;
    var selectedEmp = $('#empleado').select2("data");
    var nEmpleados=0;
    var empleados=new Array();
    var producto = document.querySelector("#nombres").value;
    var totalPuntos = document.querySelector("#totalPunto").value;
    var totalPorcentaje = document.querySelector("#totalPorcentaje").value;

    for (var i = 0; i <= selectedEmp.length-1; i++) {
            // console.log(selectedEmp[i].text);
            empleados.push(selectedEmp[i].text);
            nEmpleados++;
        }

    // console.log(fecha+' '+empleados[0].id);
    // console.log(producto+ ' '+totalPuntos+' '+totalPorcentaje);

        //for(var j=0; j<nEmpleados;j++){
          //  console.log(empleados[j].text);
        //}
        
        var inputs = document.querySelectorAll('#padre');
        var dataInputs = new Array();
        for(let items of inputs){
            // console.log(items.children.item(0).textContent+'-'+items.children.item(1).value);
            dataInputs.push(items.children.item(0).textContent+':'+items.children.item(1).value);
        }


    var data = 'fecha='+fecha+'&empleados='+empleados+'&producto='+producto+'&tpuntos='+totalPuntos+'&tporcentaje='+totalPorcentaje+'&inputs='+dataInputs+'&area='+areaSelec;
    var requestAdd = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxAdd = base_url+'control/setRep';
    requestAdd.open('POST', ajaxAdd, true);
    requestAdd.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    requestAdd.send(data);
    requestAdd.onreadystatechange = function(){
        if(requestAdd.readyState == 4 && requestAdd.status == 200) {
            // console.log(requestAdd.responseText);
            var objAdd = JSON.parse(requestAdd.responseText);
            if(objAdd.status){
                console.log(objAdd.msg);
                tablePreRep.ajax.reload();
            }else{
                console.log(objAdd.msg);
            }
        }
    }

});

