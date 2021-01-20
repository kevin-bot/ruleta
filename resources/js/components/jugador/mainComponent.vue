<template>
    <div class="container">  
        <button class="btn btn-success mb-2" @click="crear = !crear">Crear Nuevo Jugador</button>
        <div class="col-12 col-sm-10 col-lg-10 mx-auto mb-4" v-if="crear">
            <jugador-crear-component @close="closeCrear"></jugador-crear-component>            
        </div>      
        <div class="col-12 col-sm-10 col-lg-10 mx-auto mb-4" v-if="editar">
            <jugador-editar-component @closeEdit="closeEditar" :jugador='jugadorEditar'></jugador-editar-component>
        </div>
        <div class="col-12 col-sm-10 col-lg-10 mx-auto">
            <h3 class="text-center">Listado de jugadores registrados</h3>        
            <table class="table" id="mytablejugadores">
                <thead>
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>                    
                        <th scope="col">Teléfono</th>                    
                        <th scope="col">Direccion</th>                    
                        <th scope="col">Dinero</th>                    
                        <th scope="col">Opciones</th>                    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="jugador in jugadores" v-bind:key="jugador.id">                
                        <td>{{jugador.documento}}</td>    
                        <td>{{jugador.nombres}}</td>
                        <td>{{jugador.apellidos}}</td>                    
                        <td>{{jugador.telefono}}</td>    
                        <td>{{jugador.direccion}}</td>
                        <td>{{jugador.dinero}}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" @click="Seteditar(jugador)">Editar</button>
                            <button class="btn btn-danger btn-sm mt-2" @click="eliminarJugador(jugador)">Eliminar</button>
                        </td>
                    </tr>    
                </tbody>
            </table>                        
        </div>        
    </div>
</template>

<script>
    import datables from 'datatables';
    export default {
        mounted(){
            this.getjugadores();
        },
        data(){
            return {         
                crear: false,  
                editar:false,             
                jugadores : [],
                jugadorEditar : {}
            }
        },   
        methods: {
            mytable(){
                $( function () {                
                    $('#mytablejugadores').DataTable({
                        language:{
                        "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            "buttons": {
                                "copy": "Copiar",
                                "colvis": "Visibilidad"
                            }
                        }
                    });                                 
                });
            },
            getjugadores(){
                //recupera todos los judagores de la bd y los muestra en la datatable
                var urljugadores="jugador";  
                axios.get(urljugadores).then(response=>{                
                    this.jugadores= response.data.jugadores;
                    this.mytable()            
                });
            },
            Seteditar(jugador){                
                this.editar = true;
                this.jugadorEditar  = jugador;
            },
            closeEditar(closeEdit){
                this.editar = closeEdit;
            },
            closeCrear(close){
                this.crear = close;
            },
            eliminarJugador(jugador){
                if (confirm('Realmente desea eliminar este jugador')){
                    axios.delete(`jugador/${jugador.id}`)
                    .then((response)=>{
                        if (response.data.result == "exito"){                            
                            alert('Eliminado con exito');
                        }
                    }).catch()
                }
            }
        }    
    }
</script>