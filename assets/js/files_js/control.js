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


const labelsInput = document.querySelector("#col-uno");

/* const label_rec = ['Cabecera', 'Tocador', 'Buro', 'Luna'];
const label_fc=["Frentes","Cajones","Puertas","Resplado","Barrote",""];

const label_buro = ['Buro'];
const label_litera = ['CajonChica','CajonGrande'];
const label_comedor = ['Pedestal','Cubierta','Bufetera','Trinchador'];
const label_cajonera = ['Cajonera'];
const label_jgo = ['Mesa','Lateral','Lateral']; */

// var links='';
var ul = document.getElementById("areas");
let areaClick;
$( document ).ready(function() {
    var requestArea = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxArea = base_url+'control/getAreas';
        requestArea.open('POST',ajaxArea,true);
        requestArea.send();
        requestArea.onreadystatechange = function(){
            if(requestArea.readyState==4 && requestArea.status==200){
                var objAreas = JSON.parse(requestArea.responseText);
                // console.log(objAreas);
                objAreas.data.forEach((elemnt,index)=>{
                    // console.log(elemnt[1]);
                    // ul.innerHTML += '<li class="pillArea" id="'+elemnt[1]+'"><a href="#"><i class="fa fa-file-text-o"></i> '+elemnt[2]+'</a></li>';
                    const li = document.createElement('li');
                    li.classList = "pillArea";
                    li.id=elemnt[1];
                    li.setAttribute("data-capacidad",elemnt[3]);
                    li.innerHTML='<a href="#"><i class="fa fa-file-text-o"></i>'+elemnt[2]+'</a>';
                    ul.appendChild(li);
                });

                var links = document.querySelectorAll('.pillArea');
        /* console.log(ul.children.length);
        for (let node of links) {
            console.log(node);
          }  */
          
links.forEach(li =>{
    li.addEventListener('click',()=>{
        resetLinks();
        li.classList.add('active');
        $("#nombres").empty();
        // console.log(li.getAttribute('data-capacidad'));
        $("#capacidad").empty().append('<option selected disabled value="'+li.getAttribute('data-capacidad')+'">'+li.getAttribute('data-capacidad')+'</option>');
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

            }
        }
        
        
});



const names = document.querySelector('#nombres');
document.addEventListener('DOMContentLoaded', function (e) {
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

        
        cargarProducto('corte');

});



function cargarProducto(area)
{
    
    /**
         * cargar productos por areas
         */
    document.querySelector("#totalPunto").value = 0;
    document.querySelector("#totalPorcentaje").value = 0;
    var producto = document.querySelector('#nombres').value;
    labelsInput.innerHTML = "";
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

function loadCol(area,labels,producto)
{
    
    var cajas = '';
    arrayAssoc=[];
    var requestCol = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxCol = base_url+'control/getCol/'+area;
    var lbl1=0;
    requestCol.open('GET', ajaxCol, true);
    requestCol.send();
    requestCol.onreadystatechange = function(){
        if(requestCol.readyState == 4 && requestCol.status == 200){
            var objCol = JSON.parse(requestCol.responseText);
            var n_col = area != 'frentes_cajones' ? 3 : 4;
            for(let i=parseInt(n_col);i<objCol.length - parseInt(3) ;i++){
                arrayAssoc.push(objCol[i][0]);
                lbl1++;
                }

                var arrayColumns = arrayAssoc.map((element)=>{
                   return element;
                });

                var requestdata = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var ajaxData = base_url+'control/getProductData/';
                var datos = 'columns='+arrayColumns+'&area='+area+'&prod='+producto;
                requestdata.open('POST', ajaxData, true);
                requestdata.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                requestdata.send(datos);
                requestdata.onreadystatechange = function(){
                    if(requestdata.readyState == 4 && requestdata.status==200){
                        var objData = JSON.parse(requestdata.responseText);
                        for(var elem = 0;elem<arrayAssoc.length;elem++){
                            if(objData.data[0][elem] < 0.1){
                                // console.log('NO add inputs');
                            }else{
                                // console.log('si-'+elem+' = '+objData.data[0][elem]+' '+labels[elem]);
                                cajas += 
                                '<div class="form-group grid-in" name="padre" id="padre">'+
                                '<input type="hidden" id="verproducto" value="'+producto+'">'+
                                '<label for="'+labels[elem].toLowerCase()+'" class="lbls">'+labels[elem]+'</label>'+
                                '<input type="text" name="'+labels[elem].toLowerCase()+'" id="'+labels[elem].toLowerCase()+'" class="form-control por">'+
                                '<input type="text" name="puntos'+labels[elem]+'" id="puntos'+labels[elem]+'" class="form-control por" disabled>'+
                                '<input type="text" name="porcentaje'+labels[elem]+'" id="porcentaje'+labels[elem]+'" class="form-control por" disabled>'+
                                '</div>';
                            }   
                        }
                    }
                    // console.log(cajas);
                    labelsInput.innerHTML = cajas;
                }            
        }  
    }

}

function change_prod()
{      
    
    document.querySelector("#totalPunto").value = 0;
    document.querySelector("#totalPorcentaje").value = 0;

    var producto = document.querySelector('#nombres').value;
    // var inputs = '';
    var subProduct = producto.split(' ');
    /*console.log(producto);
    console.log(subProduct);
    console.log(subProduct[0]);
    console.log(subProduct[1]);*/
    

if(areaClick != 'frentes_cajones'){
    
    switch(subProduct[0]) {

        case 'REC':
            const rec = ['Cabecera', 'Tocador', 'Buro', 'Luna'];
            loadCol(areaClick,rec,producto);
        break;

        case 'BURO':
            const buro = ['Cabecera', 'Tocador', 'Buro', 'Luna'];
            loadCol(areaClick,buro,producto);
        break;
        case 'LITERA':
            const litera = ['CajonChico', 'CajonGrande'];
            loadCol(areaClick,litera,producto);
        break;
        case 'COMEDOR':
            const comedor = ['Pedestal','Cubierta','Bufetera','Trinchador'];
            loadCol(areaClick,comedor,producto);
        break;
        case 'CAJONERA':
                const cajonera = ['Cajonera'];
                loadCol(areaClick,cajonera,producto);
            break;
        case 'CENTRO':
                const centro = ['Centro'];
                loadCol(areaClick,centro,producto);
            break;
        case 'BUFETERA':
                const bufetera = ['Bufetera'];
                loadCol(areaClick,bufetera,producto);
            break;
            case 'JGO':
                const jgo = ['Centro','Lateral','Lateral'];
                loadCol(areaClick,jgo,producto);                
            break;
        case 'MESA':
                var mesa = (subProduct[3]=='TOSCANO') ? ['Centro','Lateral','Lateral'] : ["Centro"];
                loadCol(areaClick,mesa,producto);
            break;
        case 'TORRE':
            case 'SEPARADOR':
                var t_s = subProduct[0] =='TORRE' ? ['Torre'] : ['Separador'];
                loadCol(areaClick,t_s,producto);
            break;
        case 'ARMARIO':
                var armario = ["Armario"];
                loadCol(areaClick,armario,producto);
            break;
        case 'BAR':
                var bar = ["Bar"];
                loadCol(areaClick,bar,producto);
            break;

        default:
            loadCol(areaClick,'',producto);
        break;
    }

}
else{
    switch(subProduct[0]) {

        case 'REC':
            case 'BURO':
                case 'LITERA':
                    case 'ARMARIO':
                        var rec = [];
                        if(subProduct[1]=='FRANCIA'){
                            rec = ['Frentes', 'Cajones', 'Puertas', 'Respaldos','Barrotes'];
                        }else{
                            rec = ['Frentes', 'Cajones', 'Puertas', 'Respaldos'];  
                        }
            
            loadCol(areaClick,rec,producto);
        break;

        /* case 'BURO':
            const buro = ['Frentes', 'Cajones', 'Puertas', 'Respaldos'];
            loadCol(areaClick,buro,producto);
        break;
        case 'LITERA':
            const litera = ['Frentes', 'Cajones', 'Puertas', 'Respaldos'];
            loadCol(areaClick,litera,producto);
        break;
        case 'CAJONERA':
                var cajonera = ['Frentes','Cajones','Puertas','Respaldo'];
                loadCol(areaClick,cajonera,producto);
            break; */
        case 'COMEDOR':
            var comedor = [];
            if(subProduct[1]=='LISBOA' || subProduct[1]=='TURIN'){
                comedor = ['Efectos', 'Tiras'];
            }else{
                comedor = ['Frentes', 'Cajones', 'Puertas', 'Respaldos'];
            }
            
            loadCol(areaClick,comedor,producto);
        break;
        case 'CAJONERA':
                var cajonera = ['Frentes','Cajones','Puertas','Respaldo'];
                loadCol(areaClick,cajonera,producto);
            break;
        case 'CENTRO':
            var centro = [];
            if(subProduct[2]=='MARLIN'){
                centro = ['Frentes','Cajones','Respaldo','Entrepaño','Tiras'];
            }else if(subProduct[2]=='SANTAYO'){
                centro = ['Frentes','Cajones','Tira'];
            }
            else{
                centro = ['Frentes','Cajones','Puertas','Respaldos'];
            }
            
                loadCol(areaClick,centro,producto);
            break;
        case 'BUFETERA':
                var bufetera = [];
                if(subProduct[1]=='TURIN' || subProduct[1]=='LISBOA'){
                    bufetera = ['Frentes','Cajones','Puertas','Efectos'];
                }else{
                    bufetera = ['Frentes','Cajones','Puertas','Respaldos'];
                }
                // console.log(subProduct[1]);
                loadCol(areaClick,bufetera,producto);
            break;
            case 'JGO':
                // case 'MESA':
                // const jgo = ['Efecto'];
                var jgo = [];
                if(subProduct[2]=='LAURENCE'){
                    jgo = ['Frentes','Cajones','Puertas','Respaldo'];
                }else{
                    jgo = ['Efecto'];
                }
                // console.log(subProduct[2]);
                loadCol(areaClick,jgo,producto);                
            break;
        /* case 'MESA':
                var mesa = (subProduct[3]=='TOSCANO') ? ['Centro','Lateral','Lateral'] : ["Centro"];
                loadCol(areaClick,mesa,producto);
            break; */
        /* case 'TORRE':
            case 'SEPARADOR':
                var t_s = subProduct[0] =='TORRE' ? ['Torre'] : ['Separador'];
                loadCol(areaClick,t_s,producto);
            break; */
        /* case 'ARMARIO':
                var armario = ["Armario"];
                loadCol(areaClick,armario,producto);
            break; */
        case 'BAR':
                var bar = ['Frentes','Cajones','Puertas','Respaldo','Botellero', 'Portahielo'];
                loadCol(areaClick,bar,producto);
            break;

        default:
            loadCol(areaClick,'',producto);
        break;
    }
}

    // console.log(arrayAssoc);
}

/**
 * Agregar clase active
 */

/* var links = document.querySelectorAll('.areas li');
let areaClick;
links.forEach(li =>{
    li.addEventListener('click',()=>{
        resetLinks();
        li.classList.add('active');
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
} */
/*      END clase active       */



document.querySelector("#btnCalcular").addEventListener('click', ()=>{
    /**
     * obtener numero de personas y capacidad
     */
    var selectedEmp = $('#empleado').select2("data");
    var capacidadArea = document.querySelector("#capacidad").value;
    var nEmpleados = capacidadArea ==1 ? 1 : selectedEmp.length;
    var html = document.querySelectorAll('#padre');
    var selectProd = document.querySelector('#nombres').value;
    
    var requestElemt = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft:XMLHTTP");
    var urlElemet = base_url+'control/getProducto';
    var datos = 'producto='+selectProd+'&area='+areaClick;
    requestElemt.open('POST', urlElemet, true);
    requestElemt.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    requestElemt.send(datos);
    requestElemt.onreadystatechange = function () {
        if(requestElemt.readyState == 4 && requestElemt.status == 200) {
            var objElem = JSON.parse(requestElemt.responseText);
            // console.log(objElem);
            shareInfoLen = Object.keys(objElem.data[0]).length / 2;

            const valInputs = [];
            var indiceArr = 0;
            var countCol = (areaClick != 'frentes_cajones') ? 3 : 4;
            for(let i=countCol; i<shareInfoLen-3; i++){
                if(objElem.data[0][i] > 0){
                    valInputs.push(objElem.data[0][i]);
                }
            }

            var totalPuntos=0;
            var totalPorcentaje=0;
            if(areaClick=='frentes_cajones'){
                var piezas = objElem.data[0]['piezas'].split("-");
                // console.log(piezas[0].charAt(0));
                html.forEach((itemm, index)=>{
                    // console.log(piezas[index].charAt(0));
                    itemm.children.item(3).value = (itemm.children.item(1).textContent=='Buro') ? 
                                                    ((itemm.children.item(2).value/2) * (valInputs[index] / piezas[index].charAt(0))) : 
                                                    (itemm.children.item(2).value * (valInputs[index]/piezas[index].charAt(0)));
                    itemm.children.item(4).value = parseFloat((itemm.children.item(3).value * 100) / ((objElem.data[0]['capacidad'] * objElem.data[0]['puntos']) / capacidadArea));
                    totalPuntos += parseFloat(itemm.children.item(3).value);
                    totalPorcentaje += parseFloat(itemm.children.item(4).value);
                });
            }else{
                html.forEach((itemm, index)=>{
                itemm.children.item(3).value = (itemm.children.item(1).textContent=='Buro') ? 
                                                ((itemm.children.item(2).value/2) * valInputs[index]) : (itemm.children.item(2).value * valInputs[index]);
                itemm.children.item(4).value = parseFloat((itemm.children.item(3).value * 100) / ((objElem.data[0]['capacidad'] * objElem.data[0]['puntos']) / capacidadArea));
                totalPuntos += parseFloat(itemm.children.item(3).value);
                totalPorcentaje += parseFloat(itemm.children.item(4).value);
                });
            }
            /* html.forEach((itemm, index)=>{
                itemm.children.item(3).value = (itemm.children.item(1).textContent=='Buro') ? 
                                                ((itemm.children.item(2).value/2) * valInputs[index]) : (itemm.children.item(2).value * valInputs[index]);
                itemm.children.item(4).value = parseFloat((itemm.children.item(3).value * 100) / ((objElem.data[0]['capacidad'] * objElem.data[0]['puntos']) / capacidadArea));
                totalPuntos += parseFloat(itemm.children.item(3).value);
                totalPorcentaje += parseFloat(itemm.children.item(4).value);
            }); */

            document.querySelector("#totalPunto").value = totalPuntos.toFixed(2);
            document.querySelector("#totalPorcentaje").value = totalPorcentaje.toFixed(2);
            
        }

    }

});

/**
 * Guardar Datos Calculados
 */
    
document.querySelector('#btnSave').addEventListener('click', function(){
    var fecha = document.querySelector("#datepicker").value;
    var selectedEmp = $('#empleado').select2("data");
    var nEmpleados=0;
    var empleados=new Array();
    var producto = document.querySelector("#nombres").value;
    var totalPuntos = document.querySelector("#totalPunto").value;
    var totalPorcentaje = document.querySelector("#totalPorcentaje").value;

    for (var i = 0; i <= selectedEmp.length-1; i++) {
            empleados.push(selectedEmp[i].text);
            nEmpleados++;
        }

    
        
        var inputs = document.querySelectorAll('#padre');
        var dataInputs = new Array();
        for(let items of inputs){
            dataInputs.push(items.children.item(1).textContent+':'+items.children.item(2).value);
        }
// console.log(dataInputs);

    var data = 'fecha='+fecha+'&empleados='+empleados+'&producto='+producto+'&tpuntos='+totalPuntos+'&tporcentaje='+totalPorcentaje+'&inputs='+dataInputs+'&area='+areaClick;
    var requestAdd = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxAdd = base_url+'control/setRep';
    requestAdd.open('POST', ajaxAdd, true);
    requestAdd.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    requestAdd.send(data);
    requestAdd.onreadystatechange = function(){
        if(requestAdd.readyState == 4 && requestAdd.status == 200) {
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

