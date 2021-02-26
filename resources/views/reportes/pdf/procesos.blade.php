<html>
<head>
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      /* margin: 100px 50px; */
      /* Arriba | Derecha | Abajo | Izquierda */
      margin: 100px 50px 50px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -90px;
      right: 0px;
      height: 100px;
      background-color: #ddd;
      text-align: center;
    }
    header h1{
      margin: 30px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: 0px;
      right: 0px;
      height: 15px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
      font-style: italic;
      font-size: 15px;
      
    }
    footer .izq {
      text-align: left;
    }
    table{
        width:100%;
        table-layout: fixed;
        overflow-wrap: break-word;
    }
  </style>
<body>
  <header>
    <h1>
      <table>
        <tr  width="100%">
          <td> col 1: logo 1</td>
          <td>"Año del Bicentenario del Perú: 200 años de Independencia"</td>
          <td style="text-align: right;"> col 3: logo 1</td>
        </tr>
      </table>
    </h1>
    <h4>Proceso de Contratación CAS N° 00-2020</h4>
    <label for=""><strong>NOMBRE DE LA CONVOCATORIA: </strong>ESPECIALISTA EN GESTIÓN INTERNA</label> <br>
    <b style="color:blue">PUBLICACIÓN DE RESULTADOS DE EVALUACIÓN CURRICULAR</b>
    <ul></ul> 
  </header>
<br><br><br>
    <table border="1" style="border solid">
        <thead >
            <tr>
                <th rowspan="2">Orden de Mérito</th>
                <th rowspan="2">Apellidos y Nombres</th>                                                    
                <th rowspan="2">Puntaje</th>
                <th colspan="2">Resultado</th>
                <th colspan="2">Entrevista</th>                                             
            </tr>
            <tr>
                <th>Califica</th>
                <th>No Califica</th>
                <th>Fecha</th>
                <th>Hora</th>                                                  
            </tr>
        </thead>
        <tbody id="zeroconfig3_body">
                <!-- Cuerpo vacio -->                                                
        </tbody>                                            
    </table>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              Selección de personal
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <br><br><br><br>
  <div id="content">
    <p>
      Lorem ipsum dolor sit...
    </p><p>
        @for($i=0;$i<=300;$i++)
        Vestibulum pharetra fermentum fringilla  Vestibulum pharetra pharetra pharetra y la v ferment um fringilla ...<br>
        @endfor
        
    </p>
    <p style="page-break-before: always;"> <!-- salto de pagina -->
    Podemos romper la página en cualquier momento...</p>
    </p><p>
    Praesent pharetra enim sit amet...
    </p>
  </div>
</body>
</html>