
function openModal(){
    document.querySelector("#idUsr").value = "";
    document.querySelector("#titleModal").innerHTML = "Nuevo usuario";
    document.querySelector("#actionForm").classList.replace("btn-primary", "btn-success");
    document.querySelector("#btnText").innerHTML = "Guardar";    
    document.querySelector("#form_user").reset();
    $('#myModal').modal('show');
}


document.addEventListener('DOMContentLoaded', function(){
    tablaUsuarios = $('#tableUser').DataTable({
        language: {
            url: 'assets/js/spanish/Spanish.json'
        },
        "ajax": {
            "url": " "+ base_url+'user/getUsers',
            "dataSrc": ""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"usuario"},
            {"data":"acciones"}
        ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLegth": 10,
        "order": [[0, "asc"]]
        });
});


var formUser = document.querySelector("#form_user");
formUser.onsubmit = function(e){
    e.preventDefault();
    var formData = new FormData(formUser);
    var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUrl = base_url+'user/setUser';
    request.open('POST', ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            console.log(request.responseText);
            var objUser = JSON.parse(request.responseText);
            if(objUser.status){
                $('#myModal').modal("hide");
                formUser.reset();
                tablaUsuarios.ajax.reload();
            }else{
                console.log('Ocurrio un error');
            }
        }
    }
}

document.addEventListener('click', (e)=>{
    if(e.target.matches('.editUsr')){
        updUser(e);   
    }
    if(e.target.matches('.delUsr')){
        delUser(e);
    }
});

function updUser(e)
{
    var id=e.target.getAttribute('data-id');
    document.querySelector('#titleModal').innerHTML = "Actualizar";
    document.querySelector("#actionForm").classList.replace("btn-primary", "btn-success");
    document.querySelector("#btnText").innerHTML = "Actualizar";
    
    var requesUpd = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    var ajaxUpd = base_url+"user/getUser/"+id;
    requesUpd.open('GET', ajaxUpd, true);
    requesUpd.send();
    requesUpd.onreadystatechange = function() {
        if(requesUpd.readyState == 4 && requesUpd.status == 200) {
            // console.log(requesUpd.responseText);
            var objUpd = JSON.parse(requesUpd.responseText);
            // console.log(objUpd.data[0]['id_user']);
            document.querySelector("#idUsr").value = objUpd.data[0]['id_user'];
            document.querySelector("#nombre").value = objUpd.data[0]['nombre'];
            document.querySelector("#usuario").value = objUpd.data[0]['usuario'];
            $("#myModal").modal('show');
        }
    }
}

function delUser(e)
{
    var id = e.target.getAttribute('data-id');
    var opcion = confirm("Click en Aceptar para eliminar o Cancelar");
    if (opcion == true) {
        var requestDel = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxDel = base_url+'user/delUser';
        var dato = 'idUsr='+id;
        requestDel.open('POST', ajaxDel, true);
        requestDel.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        requestDel.send(dato);
        requestDel.onreadystatechange = function() {
            if(requestDel.readyState == 4 && requestDel.status == 200) {
                console.log(requestDel.responseText);
                var objDelUsr = JSON.parse(requestDel.responseText);
                if(objDelUsr.status){
                    console.log('Dato eliminado');
                    tablaUsuarios.ajax.reload();
                }else{
                    console.log('Ocurrio un error');
                }
            }
        }
	} 
    /*else {
	    mensaje = "Has clickado Cancelar";
	}*/
	// document.getElementById("ejemplo").innerHTML = mensaje;
}