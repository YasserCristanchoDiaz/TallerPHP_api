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
  const data = {
    id: document.getElementById('id').value,
    nombre: document.getElementById('name').value,
    apellido: document.getElementById('lastName').value,
    edad: document.getElementById('age').value,
    peso: document.getElementById('weight').value,
    estatura: document.getElementById('height').value,
    id_disciplinas: document.getElementById('sports').value,
  }

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

