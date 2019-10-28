window.addEventListener("load", listener);
var url_server =
  "http://localhost/practice_certification_level3/practice2-api-rest/api/futbolistas";

function listener() {
  tbody();
  document.getElementById("btn-create").addEventListener("click", save);
  document.getElementById("btn-update").addEventListener("click", save);
  document.getElementById("btn-reset").addEventListener("click", limpiar);
}

function tbody() {
  fetch(url_server)
    .then(res => {
      return res.json();
    })
    .then(response => {
      var contenido = "";
      response.forEach(element => {
        contenido += `
           <tr>
           <td>${element.nombre}</td>
           <td>${element.estatura}</td>
           <td>${element.peso}</td>
           <td>${element.procedencia}</td>
           <td><button type="button" class="btn btn-warning" value="${element.id}" name="btn-mostrar">Editar</button></td>
           <td><button type="button" class="btn btn-danger" value="${element.id}" name="btn-eliminar">Editar</button></td>
       </tr>`;
      });
      document.getElementById("table-content").innerHTML = contenido;
    })
    .then(() => {
      asignEvents();
    });
}

function asignEvents() {
  var btnMostrar = document.getElementsByName("btn-mostrar");
  var btnEliminar = document.getElementsByName("btn-eliminar");
  for (let i = 0; i < btnMostrar.length; i++) {
    btnMostrar[i].addEventListener("click", show);
    btnEliminar[i].addEventListener("click", borrar);
  }
}

function save(e) {
  e.preventDefault();
  let form = document.getElementById("form-players");
  let data = new FormData(form);
  var method = "";
  var object = {};
  if (data.get('nombre') && data.get('estatura') && data.get('peso') && data.get('procedencia')) {
    if(data.get('nombre').length > 50){
      alert("Debes agregar un nombre mas corto");
      return false;
    }
    if(data.get('estatura') > 4 || data.get('estatura') < 0.5){
      alert("La estatura de estar en rango de 0.5 a 4.0 metros")
      return false;
    }
    if(data.get('peso') > 400 || data.get('peso') < 5){
      alert("La peso de estar en rango de 5 a 400 libras")
      return false;
    }
    data.forEach(function(value, key) {
      object[key] = value;
    });
    var json = JSON.stringify(object);
    if (this.value == "create") {
      method = "POST";
    }
    if (this.value == "update") {
      method = "PUT";
    }
    fetch(url_server, {
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      method: method,
      body: json
    })
      .then(res => {
        return res.json();
      })
      .then(response => {
        tbody();
        limpiar();
        document.getElementById('msg-alert').innerHTML = `
        <div class="alert alert-${(method == "POST")? 'info':'success'}" role="alert">
        <strong>${(method == "POST")? "Nuevo registro agregado" : "Registro modificado"}</strong>
        </div>
        `;
      });
  }else{
    alert("Los campos no pueden estar vacios");
  }
}

function limpiar() {
  document.getElementById('form-players').reset();
  document.getElementById("btn-create").style= "display: inline-block";
  document.getElementById("btn-update").style= "display: none";
  document.getElementById('msg-alert').innerHTML = ``;
}

function show() {
  console.log("edit");
  fetch(url_server + "/" + this.value)
    .then(res => {
      return res.json();
    })
    .then(response => {
      document.getElementsByName('id')[0].value = response.id;
      document.getElementsByName('nombre')[0].value = response.nombre;
      document.getElementsByName('estatura')[0].value = response.estatura;
      document.getElementsByName('peso')[0].value = response.peso;
      document.getElementsByName('procedencia')[0].value = response.procedencia;
      
      document.getElementById("btn-update").style= "display: inline-block";
      document.getElementById("btn-create").style= "display: none";
    });
}

function borrar() {
  console.log("eliminar");
  if (confirm("¿Desea eliminar el registro?")) {
    fetch(url_server + "/" + this.value, {
      method: "DELETE"
    })
      .then(res => {
        return res.json();
      })
      .then(response => {
        // console.log(response);
        tbody();
        limpiar();
      });
  }
}
