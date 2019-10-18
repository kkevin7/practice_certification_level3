window.addEventListener("load", listener);
var url_server =
  "http://localhost/practice_certification_level3/ensayo1_level3/api/producto";

function listener() {
  tbody();
  document.getElementById("btn-add").addEventListener("click", guardar);
  document.getElementById("btn-update").addEventListener("click", guardar);
  document.getElementById("btn-cancel").addEventListener("click", limpiar);
}

function asignEvents() {
  let btnDelete = document.getElementsByClassName("btn-delete");
  let btnMostrar = document.getElementsByClassName("btn-mostrar");
  console.log(btnMostrar.length);
  for (let i = 0; i < btnMostrar.length; i++) {
    console.log("sdsdsdd");
    btnDelete[i].addEventListener("click", borrar);
    btnMostrar[i].addEventListener("click", mostrar);
  }
}

function tbody() {
  fetch(url_server)
    .then(res => {
      return res.json();
    })
    .then(response => {
      var contenido = "";
      //   console.log(response);
      response.forEach(ele => {
        contenido += `
            <tr>
            <td>${ele.nombre}</td>
            <td>${ele.cantidad}</td>
            <td>${ele.precio_unitario}</td>
            <td>${ele.estado}</td>
            <td><button type="submit" class="btn btn-warning btn-mostrar" value="${ele.id_producto}" >Editar</button></td>
            <td><button type="submit" class="btn btn-danger btn-delete" value="${ele.id_producto}" >Eliminar</button></td>
            </tr>
            `;
      });
      document.getElementById("content").innerHTML = contenido;
      asignEvents();
    });
}

function guardar(e) {
  e.preventDefault();
  let form = document.getElementById("form-productos");
  let datos = new FormData(form);
  if(datos.get('nombre') != "" && datos.get('precio_unitario') != "" && datos.get('cantidad') != ""){
      if(datos.get('precio_unitario') < 0 || datos.get('cantidad') < 0){
          alert("las cantidad deben ser mayores a cero");
          return false;
      }
    var object = {};
  datos.forEach(function(value, key) {
    object[key] = value;
  });
  var json = JSON.stringify(object);
  console.log(json);
  let method = "";
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
    .then(res => {
      console.log(res);
      limpiar();
      tbody();
    });
  }else{
      alert("Por favor llenes los campos")
      return false;
  }
}

function borrar(e) {
  e.preventDefault();
  if (confirm("¿Desea eliminar el registro?")) {
    fetch(url_server + "/" + this.value, {
      method: "DELETE"
    }).then(res => {
      tbody();
    });
  } else {
    return false;
  }
}

function limpiar(){
    document.getElementById('form-productos').reset();
    document.getElementById('div-estado').style = "display: none";
    document.getElementById('btn-add').style = "display: inline-block";
    document.getElementById('btn-update').style = "display: none";
}

function mostrar(e) {
  e.preventDefault();
  fetch(url_server + "/" + this.value)
    .then(res => {
      return res.json();
    })
    .then(res => {
      console.log(res);
      document.getElementsByName("id_producto")[0].value = res.id_producto;
      document.getElementsByName("nombre")[0].value = res.nombre;
      document.getElementsByName("precio_unitario")[0].value = res.precio_unitario;
      document.getElementsByName("cantidad")[0].value = res.cantidad;

      document.getElementById("div-estado").style = "display: block";
      document.getElementsByName("estado")[0].value = res.estado;
      document.getElementById("btn-add").style = "display: none";
      document.getElementById("btn-update").style = "display: inline-block";
    });
}
