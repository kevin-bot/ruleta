<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-sm-10 col-lg-12 mx-auto">                
                <form class="bg-white py-3 px-4 shadow rounded"
                    v-on:submit.prevent="crearJugador"
                    method="post">        
                    <h1 class="display-4">Nuevo Jugador</h1>
                    <hr>                          
                        <div class="form-group">
                            <label for="docuemnto">Documento:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                name="docuemnto" 
                                value="" 
                                v-model="jugador.documento"
                                placeholder="Escriba el docuemnto del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombres:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                name="nombre" 
                                value="" 
                                v-model="jugador.nombres"
                                placeholder="Escriba el nombre del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellidos:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                name="apellido" 
                                value="" 
                                v-model="jugador.apellidos"
                                placeholder="Escriba el apellido del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                v-model="jugador.telefono"
                                name="telefono" 
                                value="" 
                                placeholder="Escriba el teléfono del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="direcion">Direción:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                v-model="jugador.direccion"
                                name="direcion" 
                                value="" 
                                placeholder="Escriba el direción del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Eléctonico:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                v-model="jugador.email"
                                name="email" 
                                value="" 
                                placeholder="Escriba el correo eléctronico del jugador..">
                        </div>  
                        <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                        <button class="btn btn-link btn-block" href="" @click="cerrar">Cancelar</button>
            
                </form>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {        
        data(){
            return { 
                jugador: {}                                             
            }
        },
        methods:{
            crearJugador(){                  
                axios.post('/jugador',this.jugador).then((response)=>{
                    if (response.data.result == "exito"){
                        alert("Exito");
                        this.$emit('close',false);
                    }
                }).catch(

                );                                                                                             
            },
            cerrar(){
                this.$emit('close',false);
            }
        }
    }
</script>