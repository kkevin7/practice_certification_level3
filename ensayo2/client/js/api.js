window.addEventListener('load', listener);
//url del server rest
var url_server = "http://localhost/ensayo2/empleados/api/empleados";

//funcion que se ejecuta al iniciar
function listener() {
    tbody();
    document.getElementById("btn-add").addEventListener("click", save);
    document.getElementById("btn-update").addEventListener("click", save);
    document.getElementById("btn-cancel").addEventListener("click", limpiar);
}

//asignacion de eventos
function asignEvents() {
    let btnMostrar = document.getElementsByClassName('btn-mostrar');
    let btnDelete = document.getElementsByClassName('btn-delete');
    //recorre los botones de la tabla
    for (let i = 0; i < btnMostrar.length; i++) {
        btnDelete[i].addEventListener('click', borrar);
        btnMostrar[i].addEventListener('click', mostrar);
    }
}

//Mostrar los registro de la tabla
function tbody() {
    fetch(url_server)
        .then(res => { return res.json() })
        .then(res => {
            var content = "";
            res.forEach(el => {
                //contenido de la tabla
                content += `
            <tr>
            <td>${el.dui}</td>
            <td>${el.nit}</td>
            <td>${el.nombre}</td>
            <td>${el.salario}</td>
            <td>${el.profesion}</td>
            <td><button type="submit" class="btn btn-warning btn-mostrar" value="${el.dui}" >Editar</button></td>
            <td><button type="submit" class="btn btn-danger btn-delete"  value="${el.dui}">Eliminar</button></td>
            </tr>
            `
            });
            //insertar el contenido en la tabla
            document.getElementById('content').innerHTML = content;
            //asignacion dde eventos
            asignEvents();
        });
}

//guardar los registros
function save(e) {
    e.preventDefault();
    //obtener el formulario
    let form = document.getElementById("form-empleados");
    //obtener el form data
    let data = new FormData(form);
    var method = "";
    var object = {};
    //validar que no se encuentren vacios
    if(data.get('dui') != "" && data.get('nit') != "" && data.get('nombre') != "" && data.get('salario') != "" && data.get('profesion') != ""){
    
    var dui = data.get('dui');
    //convertilo a object
    data.forEach(function (value, key) {
        object[key] = value;
    });
    //pasar a json los datos
    var json = JSON.stringify(object);
    if (this.value == "create") {
        console.log("Entro create");
        method = "POST";
    }
    if (this.value == "update") {
        console.log("Entro update");
        method = "PUT"
    }
    fetch(url_server, {
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        method: method,
        body: json
    })
        .then(res => {
            return res.json();
        })
        .then(res => {
            console.log(res);
            limpiar();
            tbody();
            alert("El registro fue agregado o modificado");
        }).catch( err => {
            alert("No se puede insertar el registro por que ya existe el DUI");
            console.log("Erro de la peticion: "+err);
        });
    }else{
        alert("Los campos se encuentran vacios");
    }
}

//funcion para borrar los registros
function borrar(e) {
    e.preventDefault();
    if (confirm("¿Desea eliminar el registro?")) {
        fetch(url_server + "/" + this.value, {
            method: "DELETE"
        }).then(res => {
            tbody();
            alert("El registro fue eliminado");
        });
    } else {
        return false;
    }
}

//limpiar el formulario
function limpiar() {
    document.getElementById('form-empleados').reset();
    document.getElementById('btn-add').style = "display: inline-block";
    document.getElementById('btn-update').style = "display: none";
    document.getElementById("div-dui").style = "display: block";
}

//mostrar los registros en el formualrio
function mostrar(e) {
    e.preventDefault();
    fetch(url_server + "/" + this.value)
        .then(res => {
            return res.json();
        })
        .then(res => {
            console.log(res);
            document.getElementsByName("dui")[0].value = res.dui;
            document.getElementsByName("nit")[0].value = res.nit;
            document.getElementsByName("nombre")[0].value = res.nombre;
            document.getElementsByName("salario")[0].value = res.salario;
            document.getElementsByName("profesion")[0].value = res.salario;

            document.getElementById("btn-add").style = "display: none";
            document.getElementById("div-dui").style = "display: none";
            document.getElementById("btn-update").style = "display: inline-block";
        });
}
