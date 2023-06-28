const app = new (function () {
    this.tbody = document.getElementById("tbody");
    console.log(this.tbody)

    this.listado = () => {
        fetch("../controllers/listado.php")
            .then((res) => res.json())
            .then((data) => {
                console.log(data);
                this.tbody.innerHTML = "";
                data.forEach((bodega) => {
                    this.tbody.innerHTML += `<tr>
                    <td>${bodega.id_bodega}</td>
                    <td>${bodega.nombre_bodega}</td>
                    <td>${bodega.direccion_bodega}</td>
                    <td>${bodega.dotacion_bodega}</td>
                    <td>${bodega.encargado}</td>
                    <td>${bodega.estado}</td>
                    <td>${bodega.fecha_creacion_bodega}</td>
                    <td>
                    
                    <a href="javascript:;" class="btn btn-warning btn-sm" onclick="app.editar('${bodega.id_bodega}')">Editar</a>
                    <a href="javascript:;" class="btn btn-danger btn-sm" onclick="app.eliminar('${bodega.id_bodega}')">Eliminar</a>
                    </td>
                  
                           
                </tr>`
                })
            })
            .catch((error) => console.log(error));
    }
    this.guardar = () => {
        var form = new FormData();
        form.append("id_bodega", document.getElementById("id_bodega").value);
        form.append("id_comuna", document.getElementById("id_comuna").value);
        form.append("nombre_bodega", document.getElementById("nombre_bodega").value);
        form.append("direccion_bodega", document.getElementById("direccion_bodega").value);
        form.append("dotacion_bodega", document.getElementById("dotacion_bodega").value);

        // Selecciona todos los checkboxes con name='encargados[]' que están marcados
        var checkboxes = document.querySelectorAll("input[name='encargados[]']:checked");

        // Recorre todos los checkboxes marcados
        for (var i = 0; i < checkboxes.length; i++) {
            // Agrega el valor del checkbox al objeto FormData
            form.append('encargados[]', checkboxes[i].value);
        }
        fetch("../controllers/guardar.php", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data)
                if (data.success) {
                    // Asignar id_bodega a los usuarios seleccionados

                    var encargados = document.getElementsByName("encargados[]");
                    var encargadosSeleccionados = Array.from(encargados).filter((checkbox) => checkbox.checked);
                    var id_bodega = document.getElementById("id_bodega").value;

                    encargadosSeleccionados.forEach((checkbox) => {
                        var id_usuario = checkbox.value;
                        var formUsuario = new FormData();
                        formUsuario.append("id_usuario", id_usuario);
                        formUsuario.append("id_bodega", id_bodega);

                        // Realizar la solicitud para asignar id_bodega al usuario
                        fetch("../controllers/asignar_bodega_usuario.php", {
                            method: "POST",
                            body: formUsuario,
                        })
                            .then((resUsuario) => resUsuario.json())
                            .then((dataUsuario) => {
                                console.log(dataUsuario);
                            })
                            .catch((error) => console.log(error));
                    });

                    alert("Bodega Generada con éxito");
                }
            })
            .catch((error) => console.log(error));
    };
    this.editar = (id_bodega) => {
        var form = new FormData();
        form.append("id_bodega", id_bodega);
        fetch("../controllers/editar.php", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                this.nombre_bodega.value = data.nombre_bodega;
                this.id_comuna.value = data.id_comuna;
                this.direccion_bodega.value = data.direccion_bodega;
                this.dotacion_bodega.value = data.dotacion_bodega;
                this.estado_bodega.value = data.estado_bodega;
            })
            .catch((error) => console.log(error));
    };

    this.eliminar = (id_bodega) => {
        var form = new FormData();
        form.append("id_bodega", id_bodega);
        fetch("../controllers/eliminar.php", {
            method: "POST",
            body: form,
        })
            .then((res) => res.json())
            .then((data) => {
                alert("Eliminado con éxito");
                this.listado();
            })
            .catch((error) => console.log(error));
    };

    // Llama a la función listado cuando se carga el contenido HTML
    document.addEventListener("DOMContentLoaded", () => {
        this.listado();
    });
})();



