'use_strict'
const API_URL = 'http://localhost/TallerPhp_api/TallerPHP_api/api/'

let eventosData = []

window.onload = () => {
    initDeporEv()
    initDataDepEv()
}

const initDataDepEv = () => {
    clientHTTP('GET', 'eventos/get.php').then((data)=>{
        eventosData = data;
        console.log(eventosData)
        renderEventDep()
    })
}

let participantesDep = [];

const renderEventDep = () => {
    const eventDepTable = document.querySelector('#table-eventDep');
    eventDepTable.innerHTML = ''
    eventosData.map((eventS) => {
        let row = document.createElement('tr')
        participantes(eventS.id_disciplinas);
        row.innerHTML = `
                    <td>${eventS.descripcion}</td>
                    <td>${eventS.position}</td>
                    <td>${eventS.id_disciplinas}</td>
                    `
        
        eventDepTable.appendChild(row);
    })
}

const participantes = (id_disciplinas) => {
  let participantes = [];
  console.log("participantes...")
  clientHTTP('GET', 'participantes/get.php').then((data) => {
    //console.log(data)
    participantes = data
  })
  
  console.log(id_disciplinas);

  participantes.forEach( participant => {
    if ( participant.id_disciplinas === id_disciplinas ){
      console.log(participant.nombre)
      participantesDep.push(participant.nombre);
    }
  })

  //participantesDep = participantes.filter( ( element.id_disciplinas === id_disciplinas ) => { participantesDep.push(element.nombre);})

}

const initDeporEv = () => {
    const formDepEv= document.querySelector('#form-evento')
    const sportsSelect = document.querySelector('#sportsDepEv')
  
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
  
    formDepEv.addEventListener('submit', (e) => {
      e.preventDefault()
      console.log("entra...")
      submitDepEV();
    })
  }

const submitDepEV = () => {
    const dataDE = {
        descripcion: document.getElementById('des').value,
        position: document.getElementById('pos').value,
        id_disciplinas: document.getElementById('sportsDepEv').value
    }

    clientHTTP('POST','eventos/post.php', dataDE).then((dataDE) => {
        console.log(dataDE)
    })
    
    document.getElementById('des').value = ''
    document.getElementById('pos').value = ''
    document.getElementById('sportsDepEv').value = ''

    initDataDepEv();

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
