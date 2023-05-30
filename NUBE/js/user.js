const url = '../api/api.php';
var data = [];

function readAllRelojes() {
    axios({
        method: 'GET',
        url: url,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        if (res.data.status === 'success') {
            data = res.data.data;
            llenarTabla(data);
        } else if (res.data.status === 'error') {
            window.location.href = '401.html';
        }
    }).catch(error => {
        console.error(error);
    });
}


function llenarTabla(data) {
    document.querySelector('#table-reloj tbody').innerHTML = '';
    for (let i = 0; i < data.length; i++) {
        document.querySelector('#table-reloj tbody').innerHTML += 
        `<tr>
            <td>${data[i].reloj_id}</td>
            <td>${data[i].reloj_marca}</td>
            <td>${data[i].reloj_modelo}</td>
            <td>${data[i].reloj_material_caja}</td>
            <td>${data[i].reloj_material_correa}</td>
            <td>${data[i].reloj_precio}</td>
            <td>${data[i].reloj_descripcion}</td>
            <td>
                <button type="button" onclick="deleteReloj(${data[i].reloj_id})">Delete</button>
                <button type="button" onclick="updateReloj(${data[i].reloj_id})">Update</button> 
                <button type="button" onclick="readRelojById(${data[i].reloj_id})">Read</button>
            </td>
        </tr>`;
    }
}


function deleteReloj(id_del) {
    let reloj = {
        id: id_del
    };

    axios({
        method: 'DELETE',
        url: url,
        responseType: 'json',
        data: reloj
    }).then(res => {
        console.log(res.data);
        readAllRelojes();
    }).catch(error => {
        console.error(error);
    });
}


function createReloj() {
    let reloj = {
        marca: document.getElementById('marca').value,
        modelo: document.getElementById('modelo').value,
        material_caja: document.getElementById('material_caja').value,
        material_correa: document.getElementById('material_correa').value,
        precio: document.getElementById('precio').value,
        descripcion: document.getElementById('descripcion').value
    };

    axios({
        method: 'POST',
        url: url,
        responseType: 'json',
        data: reloj
    }).then(res => {
        console.log(res.data);
        if (res.data.message === 'Duplicate data') {
            alert('Dato duplicado.');
        } else {
            readAllRelojes();
        }
    }).catch(error => {
        console.error(error);
    });
}


function updateReloj(id_update) {
    let marca_update = document.getElementById('marca').value;
    let modelo_update = document.getElementById('modelo').value;
    let material_caja_update = document.getElementById('material_caja').value;
    let material_correa_update = document.getElementById('material_correa').value;
    let precio_update = document.getElementById('precio').value;
    let descripcion_update = document.getElementById('descripcion').value;

    if (marca_update !== "") {
        let reloj = {
            id: id_update,
            marca: marca_update,
            modelo: modelo_update,
            material_caja: material_caja_update,
            material_correa: material_correa_update,
            precio: precio_update,
            descripcion: descripcion_update
        };

        axios({
            method: 'PUT',
            url: url,
            responseType: 'json',
            data: reloj
        }).then(res => {
            console.log(res.data);
            if (res.data.status === 'error') {
                alert('Dato duplicado.');
            } else {
                readAllRelojes();
            }
        }).catch(error => {
            console.error(error);
        });
    } else {
        alert("Debe colocar una marca");
    }
}

function readRelojById(id) {
    axios({
        method: 'GET',
        url: url + '?id=' + id,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        document.getElementById('marca').value = res.data.data[0].reloj_marca;
        document.getElementById('modelo').value = res.data.data[0].reloj_modelo;
        document.getElementById('material_caja').value = res.data.data[0].reloj_material_caja;
        document.getElementById('material_correa').value = res.data.data[0].reloj_material_correa;
        document.getElementById('precio').value = res.data.data[0].reloj_precio;
        document.getElementById('descripcion').value = res.data.data[0].reloj_descripcion;
    }).catch(error => {
        console.error(error);
    });
}
