<?php include('header.php'); ?>

<!-- Mensajes de error y exito -->
<div id="messages">
  <?php
   
      $success_message = $_GET['success_message'] ?? '';
      $error_message = $_GET['error_message'] ?? '';

      if (!empty($success_message)) {
          echo '<div id="success-message" class="message success">';
          echo '<i class="uil uil-check-circle"></i>';
          echo '<span>' . $success_message . '</span>';
          echo '<button class="close-button" onclick="closeMessage(\'success-message\')">Cerrar</button>';
          echo '</div>';
      }

      if (!empty($error_message)) {
          echo '<div id="error-message" class="message error">';
          echo '<i class="uil uil-times-circle"></i>';
          echo '<span>' . $error_message . '</span>';
          echo '<button class="close-button" onclick="closeMessage(\'error-message\')">Cerrar</button>';
          echo '</div>';
      }
      ?>
  </div>

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="hero-text" data-aos="zoom-out">
      <h2>Bienvenido</h2>
      <p>Este es un espacio digital con el objetivo de eliminar los tiempos extras y turnos especiales a partir de la identificación.</p>
      <p>DENSO | Apodaca, Nuevo León</p>
      <a href="#about" class="btn-get-started">Comenzar</a>

    </div>

    <div class="product-screens">
      <div class="product-screen-1" data-aos="fade-up" data-aos-delay="400">
        <img src="assets/img/Time-extra.png" alt="">
      </div>

    </div>

  </section><!-- End Hero Section -->

  <main id="main">
  <section id="about" class="section-bg">
    <div class="container-fluid" data-aos="fade-up">
      <div class="section-header">
        <span class="section-divider"></span>          
      </div>    

      <div class="container-fluid" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
            <div class="form_container">      
              <form class="form signup_form" id="overtime-form">
                <h3 class="section-title">OVERTIME</h3>

                <div class="input_box">
                  <label for="">Departamento:</label>
                  <select id="departamento" name="Turno" required>
                    <option value="">Selecciona el departamento</option>
                    <option value="Dpto_251">251 - FINAL ASSEMBLING BODY</option>
                    <option value="Dpto_252">252 - PCB SMD</option>
                    <option value="Dpto_253">253 - PCB THD</option>
                    <option value="Dpto_254">254 - PRINTING</option>
                    <option value="Dpto_255">255 - MOLDING ICT</option>
                    <option value="Dpto_271">271 - AC PANEL</option>
                    <option value="Dpto_273">273 - HUD ENSAMBLE FINAL</option>                  
                    <option value="Dpto_291">291
                       - PAINTING AND LASER</option>
                    <option value="Dpto_292">292 - SUB ASSY</option>    
                  </select>
                </div>

                <!-- Campo desplegable secundario (oculto inicialmente) -->
                <div class="input_box" id="secondary-select-group" style="display: none;">
                  <label for="secondary-select">Línea:</label>
                  <select id="secondary-select" name="secondary-select"></select>
                </div>

                <div class="input_box">
                  <label for="hc">HC:</label>
                  <input type="text" id="hc" name="hc" pattern="\d+" required />                  
                </div>
                <div class="input_box">
                  <label for="tc">TC:</label>
                  <input type="text" id="tc" name="tc" required />                  
                </div>
   
                <div class="input_box">
                <label for="tiempodisponible">Tiempo disponible (diario): Selecciona los turnos</label>                 
                </div>   

                
                <div class="input_box">
                  <div>
                      <input type="checkbox" id="turno1" name="turno" value="T1"> T1 <br>
                      <input type="checkbox" id="turno2" name="turno" value="T2"> T2 <br>
                      <input type="checkbox" id="turno3" name="turno" value="T3"> T3 <br>                      
                      <!--<input type="checkbox" id="t12h_t1" name="turno" value="12H_T1"> 12 Hrs T1 (11 horas)<br>
                      <input type="checkbox" id="t12h_t2" name="turno" value="12H_T2"> 12 Hrs T2 (11.2 horas)<br>
                      <input type="checkbox" id="turno5" name="turno" value="T5"> T5 <br>-->
                  </div>
              </div>

              <div class="input_box">
                  <label1 for="traslape">Con traslape</label1>
                  <input type="checkbox" id="traslape">
              </div>

              <div class="input_box">
                  <label1><strong>Tiempo total: </strong></label1>
                  <span id="tiempo-total-label">0 horas</span>
              </div>

              <div class="input_box">
                  <label for="eficienciareal">Eficiencia real(%):</label>
                  <input type="text" id="eficienciareal" name="eficienciareal" required />                                      
                </div>

                <div class="input_box">
                  <label for="eficiencia">Eficiencia meta TPM(%):</label>
                  <input type="text" id="eficiencia" name="eficiencia" required />                                
                </div>            

                <div class="input_box">
                  <label for="piezasPC">Cantidad de piezas por PC (diaria):</label>
                  <input type="text" id="piezasPC" name="piezasPC" required />                                   
                </div>

                <div class="input_box">
                  <label for="diaslaborales">Número de días laborales:</label>
                  <input type="text" id="diaslaborales" name="diaslaborales" required />                                   
                </div>

                <button class="button" type="button" id="calcular-btn">Calcular</button>        
                
       


              </form>   
              <!--  
              <form action="guardarPrueba.php" method="post">
              <label for="palabra">Hola</label>
              <input type="hidden" id="palabra" name="palabra" value="Hola">
              <button class="button" type="submit">Guardar</button>
          </form>-->
              
              
            </div>
          </div>
             <!-- Result Section -->
        <div class="form_container" id="result-form" style="display: none;">
                  <h3 class="section-title-1">Capacidad de la línea: </h3>
                  <div class="input_box">
                  <label ><strong>Diaria (Meta):</strong> </label>
                    <label1 id="capacidad-label"><strong></strong> </label1>
                  </div>
                  <div class="input_box">
                  <label ><strong>Diaria (Real):</strong> </label>
                    <label1 id="capacidad-label-real"><strong></strong> </label1>
                  </div>
                  
                  <div class="input_box">
                  <label ><strong>Semanal:</strong> </label>
                    <label1 id="semanal-label"><strong></strong> </label1>
                  </div>
                  <div class="input_box">
                  <label ><strong>Tiempo necesario para trabajar la línea:</strong> </label>
                    <label1 id="tiempo-linea-label"><strong></strong> </label1>
                  </div>

                  <h3 class="section-title">Tiempo extra</h3>
                  <div class="input_box">
                     <label ><strong>Piezas requeridas a realizar en tiempo extra (diario): </strong> </label>
                    <label1 id="requeridasPC-label"><strong></strong> </label1>
                  </div>
                  
                  <div class="input_box">
                  <label ><strong>Tiempo extra necesario (diario):</strong> </label>
                    <label1 id="tiempo-extra-label"><strong></strong> </label1>
                  </div>

                  <div class="input_box">
                  <label ><strong>Tiempo extra necesario (mes): </strong> </label>
                    <label1 id="tiempo-extra-mes-label"><strong></strong> </label1>
                  </div>

                 <!--<div class="input_box">
                  <label ><strong>Horas de tiempo extra (fin de semana):</strong> </label>
                    <label1 id="tiempo-extra-fin-label"><strong></strong> </label1>
                  </div> -->                 
              
                  <h3 class="section-title"></h3>

                  <div class="input_box">
                  <label ><strong>TT:</strong> </label>
                    <label1 id="tt-label"><strong></strong> </label1>
                  </div>

                  <div class="input_box">
                  <label ><strong>ATT META:</strong> </label>
                    <label1 id="att-label"><strong></strong> </label1>
                  </div>
                  <div class="input_box">
                  <label ><strong>ATT REAL:</strong> </label>
                    <label1 id="att-label-real"><strong></strong> </label1>
                  </div>


                  <h3 class="section-title-1">Costo: </h3>
                  <div class="input_box">
                  <label ><strong>$</strong> </label>
                    <label1 id="costo-label"><strong></strong> </label1>
                  </div>

                   <!-- Contenedor para mes y botón -->
                  <div class="input_box_guardar">
                      <label><strong>Mes:</strong></label>
                      <div class="select-button-container">
                          <select id="mes-select" name="mes">
                          <option value="enero">Enero</option>
                            <option value="febrero">Febrero</option>
                            <option value="marzo">Marzo</option>
                            <option value="abril">Abril</option>  
                            <option value="mayo">Mayo</option>
                            <option value="junio">Junio</option>
                            <option value="julio">Julio</option>
                            <option value="agosto">Agosto</option>
                            <option value="septiembre">Septiembre</option>
                            <option value="octubre">Octubre</option>
                            <option value="noviembre">Noviembre</option>
                            <option value="diciembre">Diciembre</option>
                              <!-- Agrega más meses aquí -->
                          </select>
                          <button class="button" type="button" id="guardar-btn">Guardar</button>

                      </div>
                  </div>                
                 </div>       
        </div>
      </div>
    </div>
  </section>


  
  
    <!-- ======= Visualizar Section ======= -->
    <section id="Visualizar" class="section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h3 class="section-title">Identificación de Tiempo Extra (Visualización por mes).</h3>
          <span class="section-divider"></span>
          <p class="section-description">.</p>
        </div>               
          
        </div>

      </div>
    </section><!-- End Team Section -->

    <?php include('footer.php'); ?>



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-chevron-up"></i></a>

  
  
  
    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script>

   <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>       

    

       <style>
      input[type="password"]::-ms-reveal,
      input[type="password"]::-webkit-reveal {
          display: none !important;
      }
    
        /* Añadir estilos adicionales para alinear el texto verticalmente */
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
        }
   
      </style>
   </body>

</html>

