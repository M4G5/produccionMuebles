document.addEventListener('DOMContentLoaded', function(e){
    tableReportes = $('#tableMuebles').DataTable({
        language: {
            url: 'assets/js/spanish/Spanish.json'
        },
        "ajax": {
            "url": " "+ base_url+'reportemuebles/getReportes',
            "dataSrc": ""
        },
        "columns":[
            {"data":"id_reporte"},
            {"data":"nombre"},
            {"data":"fecha"},
            {"data":"area"},
            {"data":"producto"},
            {"data":"descripcion"},
            {"data":"puntos"},
            {"data":"porcentaje"}
        ],
        "columnDefs": [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
        ],
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLegth": 10,
        "order": [[0, "DESC"]]
        });
});

/* $(document).ready(function() {

var requestRep = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Micrisoft.XMLHTTP");
var ajaxData = base_url+'reportemuebles/getReportes';
requestRep.open('POST', ajaxData ,true);
requestRep.send();
requestRep.onreadystatechange = function() {
    if(requestRep.readystate==4 && requestRep.status==200) {
        console.log(requestRep.responseText);
    }
}

}); */




$("#btnExport").on("click",function(event){
    event.preventDefault();
    var nombre = document.querySelector("#nombre").value;
    var inicio = document.querySelector("#fecha_inicio").value;
    var fin = document.querySelector("#fecha_fin").value;
    window.open(base_url+'templates/modules/phpExport.php?nombre='+nombre+'&start='+inicio+'&end='+fin, "_blank");
    // window.open(base_url+'templates/modules/phpExport.php', "_blank");
    
 });