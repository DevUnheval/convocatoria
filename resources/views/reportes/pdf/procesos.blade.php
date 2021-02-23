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
      height: 80px;
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
          <td> texto</td>
          <td style="text-align: right;"> col 3: logo 1</td>
        </tr>
      </table>
    </h1>
    <h2>tema</h2>
    <ul></ul>
    
  </header>
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
  <div id="content">
    <p>
      Lorem ipsum dolor sit...
    </p><p>
        @for($i=0;$i<=500;$i++)
        Vestibulum pharetra fermentum fringilla  Vestibulum pharetra pharetra pharetra y la v ferment um fringilla ...<br>
        @endfor
        
    </p>
    <p style="page-break-before: always;">
    Podemos romper la página en cualquier momento...</p>
    </p><p>
    Praesent pharetra enim sit amet...
    </p>
  </div>
</body>
</html>