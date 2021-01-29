<template>
    <div class="card">
                            <div class="card-body">
                                
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Convocatoria</th>
                                                <th>Nº plazas</th>
                                                <th>Inscripción (inicio - fin)</th>
                                                <th>Comunicados</th>
                                                <th>Bases</th>
                                                <th>Postular</th>
                                                <th>Configurar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Código</td>
                                                <td>Convocatoria</td>
                                                <td>Nº plazas</td>
                                                <td>Inscripción (inicio - fin)</td>
                                                <td>Comunicados</td>
                                                <td>Bases</td>
                                                <td>Postular</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-dark dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <div class="dropdown-menu animated slideInUp"
                                                            x-placement="bottom-start"
                                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="ti-eye"></i> Open</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="ti-pencil-alt"></i> Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="ti-trash"></i> Delete</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="ti-comment-alt"></i> Comments</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Código</th>
                                                <th>Convocatoria</th>
                                                <th>Nº plazas</th>
                                                <th>Inscripción (inicio - fin)</th>
                                                <th>Comunicados</th>
                                                <th>Bases</th>
                                                <th>Postular</th>
                                                <th>Configurar</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
</template>

<script>

 import axios from 'axios'

  export default {
  
    props:['roles'],
    data() {
        return {
           datos:[],
           rutas:[],
           datatable:[],
           modal_seleccionado:{"nombre":""},
        }
    },  

  async created () {
    //...
  },
  async mounted () {
    await this.setRutas();
    await this.data();
    this.setDatatable(); 
  },
  
  computed: {
    // a computed getter
    raiz: function () {
      if (location.hostname === "localhost"){
          return "/quipu/public/";
      }else if(location.hostname === "127.0.0.1"){
        return "/";
      } else{
        return "/";
      }
    }
  },

  methods: {
    async showNewModal(){
     
      $("#modal-maestro-nuevo").modal('show');
    },
   
    async data(){
      //axios.get('candidato/'+proceso+'/').catch(e => { console.log(e)});
      await axios.get(this.rutas["listar"])
        .then(async response => {
           this.datos=await response.data; 
           
        })
        .catch(e => {
            // Capturamos los errores
      })
    },

    async setDatatable(){
      this.datatable = await $('#data-table2').DataTable( {
					autoFill: true,
          language:{"url":"//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
          
					iDisplayLength: 10,
					order: [], //para que no se ordene solito
				} );
    },
    setRutas(){
    //   switch(this.maestro){
    //     case "usuarios":
    //        this.rutas["listar"]=this.raiz+"maestro/users/listar";
    //       break;
    //     case "postulantes": 
    //     case "asociacion":
    //     case "procesos": 
    //     case "candidatos":
    //       this.rutas["listar"]=this.raiz+this.maestro+"/listar";
    //       this.rutas["nuevo"]=this.raiz+this.maestro+"/nuevo";
    //       this.rutas["editar"]=this.raiz+this.maestro+"/editar";
    //       this.rutas["eliminar"]=this.raiz+this.maestro+"/eliminar";
    //       this.rutas["plantilla"]=this.raiz+"plantillas_excel/"+this.maestro+".xlsx";
    //       this.rutas["importar"]=this.raiz+this.maestro+"/importar";
    //       break;
    //   }
    },
    
  }
}
</script >

<style scoped>

</style>
