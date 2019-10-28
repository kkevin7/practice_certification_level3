//inializate the events
window.addEventListener("load", listener);
//speficate the url of the server
url_server = "http://localhost/certificacion/server/api/eventos";

// first method
function listener() {
    tbody();
    // asign the event to the buttons
    document.getElementById('btn-create').addEventListener('click', save);
    // asign the event to the buttons
    document.getElementById('btn-update').addEventListener('click', save);
    // asign the event to the buttons
    document.getElementById('btn-reset').addEventListener('click', clear);
}

// method use to show the data
function tbody() {
    fetch(url_server)
        .then(res => {
            //convert the response to json
            return res.json();
        })
        .then(res => {
            // inilizate the variable of the content
            var content = "";
            res.forEach(el => {
                //content of the table
                content += `
                <tr>
                <td>${el.titulo}</td>
                <td>${el.fecha_hora}</td>
                <td>${el.descripcion}</td>
                <td>${el.categoria}</td>
                <td><button type='submit' class='btn btn-warning' name="btn-show" value='${el.id}' >Editar</button></td>
                <td><button type='submit' class='btn btn-danger' name="btn-delete"  value='${el.id}'>Eliminar</button></td>
                </tr>
                `;
            });
            //insert the content in table
            document.getElementById("table-content").innerHTML = content;
        }).then(() => {
            //asign the events to the buttons
            asignEvents();
        });
}

//asign the events to the buttons
function asignEvents() {
    // button of the table
    var btnEdit = document.getElementsByName('btn-show');
    // button of the table
    var btnDelete = document.getElementsByName('btn-delete');
    for (let i = 0; i < btnEdit.length; i++) {
        //asign the click event
        btnEdit[i].addEventListener('click', show);
        //asign the click event
        btnDelete[i].addEventListener('click', borrar);
    }
}

// save reocrd in the table
function save(e) {
    // prevent the event submit
    e.preventDefault();
    // get data of the form
    let form = document.getElementById('form-events');
    // convert the data to formdata
    let data = new FormData(form);
    // inizalizate the method
    var method = '';
    var object = {};
    // verificate the filds are not empty
    if (data.get('titulo') != '' && data.get('fecha') != '' && data.get('hora') != '' && data.get('descripcion') != '' && data.get('categoria') != '') {
        //speficate the format the date
        data.append("fecha_hora", data.get('fecha')+" "+data.get('hora'));
        // get current date
        var fecha_actual = (new Date()).toISOString().split('T')[0];
        // compare the dates
        if(data.get("fecha_hora") <= fecha_actual ){
            //show a message
            alert("La fecha debe ser mayor a la fecha de hoy");
            return false;
        }
        // convert the formdata to object
        data.forEach(function (value, key) {
            object[key] = value;
        });
        // convert the objecto to json
        var json = JSON.stringify(object);
        if (this.value == 'create') {
            // console.log('Entro create');
            method = 'POST';
        }
        if (this.value == 'update') {
            // console.log('Entro update');
            method = 'PUT'
        }
        // console.log(json);
        // console.log("method: "+method);
        fetch(url_server, {
            //speficate the headers
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: method,
            body: json
        })
            .then(res => {
                // convert the data to json
                return res.json();
            })
            .then(res => {
                // console.log(res);
                // refresh the data of the table
                tbody();
                // clear the form
                clear();
                // show a message
                document.getElementById('msg-alert').innerHTML = `
                <div class="alert alert-${ method == "POST" ? "info": "success"}" role="alert">
                            <strong>${ method == "POST" ? "Regitro creado con exito": "Modificación exitosa"}</strong>
                        </div>
                `;
            }).catch(err => {
                // error of the server
                console.log('Error de la peticion: ' + err);
            });
    } else {
        // message of the filds are empty
        alert('Los campos se encuentran vacios');
    }
}

//show record on the form
function show() {
    fetch(url_server+"/"+this.value)
    .then(res => {return res.json()})
    .then(response => {
        // mostrar y ocultar botones
        document.getElementById('btn-update').style = "display: inline-block";
        // mostrar y ocultar botones
        document.getElementById('btn-create').style = "display: none";

        // insert the data in form
        document.getElementsByName("id")[0].value = response.id;
        document.getElementsByName("titulo")[0].value = response.titulo;
        // insert the data in form
        var fecha_hora = response.fecha_hora;
        var hora = fecha_hora.substr(fecha_hora.length-8, fecha_hora.length);
        var fecha = fecha_hora.substr(0, 10);
        // insert the data in form
        document.getElementsByName("fecha")[0].value = fecha;
        // insert the data in form
        document.getElementsByName("hora")[0].value = hora;
        // insert the data in form
        document.getElementsByName("descripcion")[0].value = response.descripcion;
        // insert the data in form
        document.getElementsByName("categoria")[0].value = response.categoria;
    });
}

// method clean the fild in the form
function clear() {
    // clean the filds of form
    document.getElementById('form-events').reset();
    // show and hidde the form
    document.getElementById('btn-update').style = "display: none";
    // show and hidde the form
    document.getElementById('btn-create').style = "display: inline-block";
    // show and hidde the form
    document.getElementById('msg-alert').innerHTML = ``;
}

// method used to delete record
function borrar(e) {
    //prevent the event
    e.preventDefault();
    // show a message of confirm
    if (confirm('¿Desea eliminar el registro?')) {
        fetch(url_server + '/' + this.value, {
            method: 'DELETE'
        }).then(res => {
            // refresh the data in the table
            tbody();
            // clean the forma
            clear();
            // show a message that teh record was deleted
            alert('El registro fue eliminado');
        });
    } else {
        return false;
    }
}