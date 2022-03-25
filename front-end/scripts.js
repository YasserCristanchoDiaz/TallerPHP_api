'use_strict'
const API_URL = 'http://localhost/TallerPhp_api/TallerPHP_api/api/'

let sportsData = []
let afiliadosData = []
let eventosData = []

let afiliadoFormStatus = 'Crear'

window.onload = () => {
  initAfiliadoForm()
  initDatosAfiliados()
}

// AFILIADOS ---
const initDatosAfiliados = () => {
  clientHTTP('GET', 'participantes/get.php').then((data) => {
    afiliadosData = data
    renderAfiliados()
  })
}

const renderAfiliados = () => {
  const afiliadosTable = document.querySelector('#table-afiliado')
  afiliadosTable.innerHTML = ''
  afiliadosData.map((afiliado) => {
    let row = document.createElement('tr')
    /*let disciplina = [];
    
    clientHTTP('GET', 'disciplinas/get_one.php').then((data) => {
      console.log(data)
      disciplina = data
    })*/

    row.innerHTML = `
              <td>${afiliado.id}</td>
              <td>${afiliado.nombre}</td>
              <td>${afiliado.apellido}</td>
              <td>${afiliado.edad}</td>
              <td>${afiliado.peso}</td>
              <td>${afiliado.estatura}</td>
              <td>${afiliado.id_disciplinas}</td>
              <td>
              <button class="btn btn-success" onclick="updateAfiliado(${afiliado.id})">Update</button>
              </td>
              <td>
              <button class="btn btn-danger" onclick="deleteAfiliado(${afiliado.id})">Delete</button>
              </td>
          `
    afiliadosTable.appendChild(row)
  })
}

const deleteAfiliado = (id) => {
  Swal.fire({
    title: 'Estas seguro que quieres eliminar el afiliado?',
    showDenyButton: true,
    reverseButtons: true,
    confirmButtonText: 'Eliminar',
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      clientHTTP('DELETE', `participantes/delete.php`, { id }).then((data) => {
        if (data.message === 'Success') Swal.fire('Eliminado!', '', 'success')
        else Swal.fire('Error!', '', 'error')

        initDatosAfiliados()
      })
    }
  })
}

const updateAfiliado = (id) => {
  afiliadoFormStatus = 'Actualizar'
  const afiliado = afiliadosData.find((afiliado) => afiliado.id == id)

  document.getElementById('id').value = afiliado.id
  document.getElementById('name').value = afiliado.nombre
  document.getElementById('lastName').value = afiliado.apellido
  document.getElementById('age').value = afiliado.edad
  document.getElementById('weight').value = afiliado.peso
  document.getElementById('height').value = afiliado.estatura
  document.getElementById('sports').value = afiliado.id_disciplinas
}

const initAfiliadoForm = () => {
  const formAfiliado = document.querySelector('#form-afiliado')
  const sportsSelect = document.querySelector('#sports')

  // SPORTS
  clientHTTP('GET', 'disciplinas/get.php').then((data) => {
    sportsData = data

    data.forEach((element) => {
      let option = document.createElement('option')
      option.value = element.id
      option.innerHTML = element.descripcion
      sportsSelect.appendChild(option)
    })
  })

  formAfiliado.addEventListener('submit', (e) => {
    e.preventDefault()
    submitAfiliado()
  })
}

const submitAfiliado = async () => {
  const id = document.getElementById('id').value;
  const nombre = document.getElementById('name').value;
  const apellido = document.getElementById('lastName').value;
  const edad = document.getElementById('age').value;
  const peso = document.getElementById('weight').value;
  const estatura = document.getElementById('height').value;
  const id_disciplinas = document.getElementById('sports').value;

  const alertAf = document.querySelector('#alertAf');
  alertAf.innerHTML = ''

  if ( id.length > 0 && nombre.length > 0 && apellido.length > 0 && edad > 0 && peso > 0 && estatura > 0 && id_disciplinas.length > 0 ) {
  const data = {
    id: id,
    nombre: nombre,
    apellido: apellido,
    edad: edad,
    peso: peso,
    estatura: estatura,
    id_disciplinas: id_disciplinas,
  }

  alertAf.innerHTML = `<div class="alert alert-success" role="alert">
                          Afiliado agregado.
                        </div>`

  switch (afiliadoFormStatus) {
    case 'Crear':
      await clientHTTP('POST', 'participantes/post.php', data).then((data) => {
        console.log(data)
      })
      break
    case 'Actualizar':
      Swal.fire({
        title: 'Estas seguro que quieres actualizar el afiliado?',
        showDenyButton: true,
        reverseButtons: true,
        confirmButtonText: 'Actualizar',
        denyButtonText: `Cancelar`,
      }).then(async (result) => {
        if (result.isConfirmed) {
          await clientHTTP('PUT', 'participantes/put.php', data).then((data) => {
            if (data.message === 'Success') Swal.fire('Actualizado!', '', 'success')
            else Swal.fire('Error!', '', 'error')
          })
          afiliadoFormStatus = 'Crear'
        }
      })
      break
    default:
      break
  }

  document.getElementById('id').value = ''
  document.getElementById('name').value = ''
  document.getElementById('lastName').value = ''
  document.getElementById('age').value = ''
  document.getElementById('weight').value = ''
  document.getElementById('height').value = ''
  document.getElementById('sports').value = ''

  initDatosAfiliados()

 } else {
  alertAf.innerHTML = `<div class="alert alert-danger" role="alert">
                        Asegurese que los campos no esten vacios.
                      </div>`
 }
}

// UTILS ---
const clientHTTP = async (method, url, body = null) => {
  return await fetch(`${API_URL}${url}`, {
    method: method,
    body: body ? JSON.stringify(body) : null,
    headers: {
      'Content-Type': 'application/json',
    },
  })
    .then((response) => response.json())
    .then((data) => data)
}

//EVENTO_DEPORTIVO-------

const btnDepEv = document.getElementById('btnDepEv').addEventListener('click', (e) => {
  

})

