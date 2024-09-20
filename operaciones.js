
document.addEventListener('DOMContentLoaded', function() {
    // Manejo del desplegable dinámico
    const mainSelect = document.getElementById('departamento');
    const secondarySelectGroup = document.getElementById('secondary-select-group');
    const secondarySelect = document.getElementById('secondary-select');
      
    const secondaryOptions = {
      'Dpto_251': ['780B', '920B', 'P758', 'U725', '289D', 'P703']
    };
  
    mainSelect.addEventListener('change', function() {
      const selectedValue = this.value;
  
      if (selectedValue in secondaryOptions) {
        secondarySelectGroup.style.display = 'block';
        secondarySelect.innerHTML = '';
  
        secondaryOptions[selectedValue].forEach(function(option) {
          const optionElement = document.createElement('option');
          optionElement.value = option;
          optionElement.textContent = option;
          secondarySelect.appendChild(optionElement);
        });
      } else {
        secondarySelectGroup.style.display = 'none';
        secondarySelect.innerHTML = '';
      }
    });
  
    // Para check box
    const checkboxes = document.querySelectorAll('input[name="turno"]');
    const traslapeCheckbox = document.getElementById('traslape');
    const tiempoTotalLabel = document.getElementById('tiempo-total-label');
  
    const horasTurno = {
      T1: 8.9,
      T2: 7.7,
      T3: 6.4,
      '12H_T1': 11,
      '12H_T2': 11.2,
      T5: 8.9
    };
  
    const segundosTurno = {
      T1: 32160,
      T2: 27600,
      T3: 23040,
      '12H_T1': 39600,
      '12H_T2': 40320,
      T5: 32040
    };
  
    // Ajustes por traslape en horas y segundos
    const ajustesPorTraslape = {
      T1: { horas: -0.3, segundos: -1200 },
      T2: { horas: -0.4, segundos: -1200 },
      T3: { horas: -0.3, segundos: -1200 },
      '12H_T1': { horas: 0, segundos: 0 },
      '12H_T2': { horas: 0, segundos: 0 },
      T5: { horas: 0, segundos: 0 }
    };
  
    function actualizarTiempoTotal() {
      let tiempoTotalHoras = 0;
      let tiempoTotalSegundos = 0;
  
      checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
          let turno = checkbox.value;
          let tiempoTurnoHoras = horasTurno[turno] || 0;
          let tiempoTurnoSegundos = segundosTurno[turno] || 0;
  
          let ajusteHoras = traslapeCheckbox.checked ? (ajustesPorTraslape[turno]?.horas || 0) : 0;
          let ajusteSegundos = traslapeCheckbox.checked ? (ajustesPorTraslape[turno]?.segundos || 0) : 0;
  
          tiempoTotalHoras += tiempoTurnoHoras + ajusteHoras;
          tiempoTotalSegundos += tiempoTurnoSegundos + ajusteSegundos;
        }
      });
  
      tiempoTotalHoras = parseFloat(tiempoTotalHoras.toFixed(1));
      tiempoTotalSegundos = parseInt(tiempoTotalSegundos, 10);
      
      // Actualiza la etiqueta con el total de horas
      tiempoTotalLabel.textContent = `${tiempoTotalHoras} horas`;
  
      // Guarda los valores globales en horas y segundos para usarlos en los cálculos
      window.tiempoDisponibleEnHoras = tiempoTotalHoras;
      window.tiempoDisponibleEnSegundos = tiempoTotalSegundos;
    }
  
    // Eventos para actualizar el tiempo total cuando se cambian los checkboxes
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', actualizarTiempoTotal);
    });
  
    traslapeCheckbox.addEventListener('change', actualizarTiempoTotal);
  
    const calcularBtn = document.getElementById('calcular-btn');
    const resultForm = document.getElementById('result-form');
    const capacidadLabel = document.getElementById('capacidad-label');
    const capacidadRealLabel = document.getElementById('capacidad-label-real');
    const semanalLabel = document.getElementById('semanal-label');
    const tiemponecesarioLabel = document.getElementById('tiempo-linea-label');
    const requeridasPCLabel = document.getElementById('requeridasPC-label');
    const tiempoExtraLabel = document.getElementById('tiempo-extra-label');
    const tiempoExtraMesLabel = document.getElementById('tiempo-extra-mes-label');
    const tiempoExtraFinLabel = document.getElementById('tiempo-extra-fin-label');
    const sectionTitles = document.querySelectorAll('h3.section-title'); // Seleccionar todas las etiquetas <h3>
    const conceptoSection = document.querySelector('h3.section-title:nth-of-type(3)'); // Selecciona la tercera sección que corresponde a "Concepto"
    const ttLabel =document.getElementById('tt-label');
    const attLabel = document.getElementById('att-label');
    const attRealLabel = document.getElementById('att-label-real');
    const costoLabel = document.getElementById('costo-label');


  
  
    // Función para realizar los cálculos 
    calcularBtn.addEventListener('click', function() {
      const tc = parseFloat(document.getElementById('tc').value);
      const eficiencia = parseFloat(document.getElementById('eficiencia').value);
      const eficienciareal =parseFloat(document.getElementById('eficienciareal').value);
      const piezasPC = parseFloat(document.getElementById('piezasPC').value);
      const diasLaborales = parseFloat(document.getElementById('diaslaborales').value);
      const hcc = parseFloat(document.getElementById('hc').value);
      
      if (isNaN(tc) || isNaN(window.tiempoDisponibleEnHoras) || isNaN(eficiencia) || isNaN(piezasPC)|| isNaN(eficienciareal)) {
        alert('Por favor, completa todos los campos correctamente.');
        return;
      }
  
      const eficienciaDecimal = eficiencia / 100;
      const eficienciarealDecimal = eficienciareal / 100;      
        
       // Cálculo de TT & ATT
       let tt = window.tiempoDisponibleEnSegundos / piezasPC;
       let att = (1* tc)/ eficienciaDecimal;
       let attreal =(1* tc)/ eficienciarealDecimal;

       // Cálculo de la capacidad diaria en piezas usando el tiempo en segundos
      let capacidadPiezas =window.tiempoDisponibleEnSegundos / tt;
      let capacidadRealPiezas = window.tiempoDisponibleEnSegundos / attreal;
      let capacidadSemanal = capacidadPiezas * 5;
      let tiemponecesario = (capacidadPiezas * attreal) / 3600; // Se usa 'tc' en lugar de 'TC'
      let requeridasPiezasPC = capacidadPiezas - capacidadRealPiezas;
      let tiempoExtra = tiemponecesario - window.tiempoDisponibleEnHoras ; //diario
      let tiempoExtraminutos = tiempoExtra * 60;
      let tiempoExtraSegundos = 22 * 3600 - window.tiempoDisponibleEnSegundos;
  
      let tiempoExtraMes = tiempoExtra * diasLaborales; //mes
      let tiempoExtraMesMinutos = tiempoExtraMes * 60;
      let tiempoExtraFin = tiempoExtra * 5;

       //Costo
       let costo = hcc * tiempoExtraMes * 150.2;
       //Costo con comas
       const costoFormateado = costo.toLocaleString('es-MX', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });

  
  
      capacidadLabel.innerHTML = `<strong></strong> ${capacidadPiezas.toFixed(0)} piezas`;//Diaria:
      capacidadRealLabel.innerHTML = `<strong></strong> ${capacidadRealPiezas.toFixed(0)} piezas`;//Diaria:
      semanalLabel.innerHTML = `<strong></strong> ${capacidadSemanal.toFixed(0)} piezas`;//Semanal:
      tiemponecesarioLabel.innerHTML = `<strong></strong> ${tiemponecesario.toFixed(2)} horas`;//Tiempo necesario para trabajar la línea:
      requeridasPCLabel.innerHTML = `<strong></strong> ${requeridasPiezasPC.toFixed(0)} piezas`;//Piezas requeridas a realizar en tiempo extra (diario):
      tiempoExtraLabel.innerHTML = `<strong></strong> ${tiempoExtra.toFixed(2)} horas ( ${tiempoExtraminutos.toFixed(2)} minutos)`;//Tiempo extra necesario (diario)
      tiempoExtraMesLabel.innerHTML = `<strong></strong> ${tiempoExtraMes.toFixed(2)} horas ( ${tiempoExtraMesMinutos.toFixed(2)} minutos)`;//Tiempo extra necesario (mes):

      //tiempoExtraFinLabel.innerHTML = `<strong></strong> ${tiempoExtraFin.toFixed(2)} horas`;//Horas de tiempo extra (fin de semana):
      ttLabel.innerHTML = `<strong></strong> ${tt.toFixed(2)} segundos`;//takt time en segundos
      attLabel.innerHTML = `<strong></strong> ${att.toFixed(2)} segundos`; //actual takt time en segundos    
      attRealLabel.innerHTML = `<strong></strong> ${attreal.toFixed(2)} segundos`; //actual takt time en segundos
      costoLabel.innerHTML = `<strong>${costoFormateado} MXN Mensual</strong>`;


      // Comprobar si alguno de los valores es negativo y actualizar el título
      if (requeridasPiezasPC < 0 || tiempoExtra < 0 || tiempoExtraMes < 0) {
        sectionTitles[1].textContent = 'Resultado: Deducible'; // Actualiza el segundo
        //COMO ES DEDUCIBLE NO DEBE HABER CONCEPTO DE TIEMPO EXTRA!
        conceptoSection.textContent = ' ';
         //Verificar si TC > TT y actualizar el texto de la sección "Concepto"          
        

        
        
      } else {
        sectionTitles[1].textContent = 'Resultado: Tiempo extra'; // Actualiza el segundo <h3 class="section-title">
             
              
      }

      if (attreal > tt) {
        conceptoSection.textContent = 'Concepto: Falta de capacidad instalada en línea.';
            }  //BIEN

              else if (attreal > att) { //META
                  conceptoSection.textContent = 'Concepto: Falta de capacidad por eficiencia encima de mi meta TPM ';
                  //Att  mayor al att meta
              } 
            else if (att > attreal) { //REAL
                conceptoSection.textContent = 'Concepto: Falta de capacidad por no alcanzar meta de eficiencia de TPM';
            
            }
           
            else {
                  
              } 

  
      resultForm.style.display = 'block';
    });
  });





  // Efecto scroll suave
document.querySelectorAll('a.scrollto').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    
    const target = document.querySelector(this.getAttribute('href'));
    target.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  });
});