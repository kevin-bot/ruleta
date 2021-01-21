<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12 col-sm-10 col-lg-12 mx-auto">                
                <form class="bg-white py-3 px-4 shadow rounded"
                    v-on:submit.prevent="editarJugador"
                    method="post">        
                    <h1 class="display-4">Editar Jugador</h1>
                    <hr>                          
                        <div class="form-group">
                            <label for="docuemnto"><i class="fas fa-address-card"></i> Documento:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                name="docuemnto" 
                                
                                v-model="jugador.documento"
                                placeholder="Escriba el docuemnto del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="nombre"><i class="fas fa-user"></i> Nombres:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                name="nombre" 
                                
                                v-model="jugador.nombres"
                                placeholder="Escriba el nombre del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="apellido"><i class="fas fa-user"></i> Apellidos:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                name="apellido" 
                                
                                v-model="jugador.apellidos"
                                placeholder="Escriba el apellido del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="telefono"><i class="fas fa-phone"></i> Teléfono:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                v-model="jugador.telefono"
                                name="telefono" 
                                
                                placeholder="Escriba el teléfono del jugador..">
                        </div>

                        <div class="form-group">
                            <label for="direcion"><i class="fas fa-map-marker-alt"></i> Direción:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                v-model="jugador.direccion"
                                name="direcion" 
                                
                                placeholder="Escriba el direción del jugador..">
                        </div>
                        
                        <div class="form-group">
                            <label for="dinero"><i class="fas fa-money-bill-alt"></i> Dinero:*</label>
                            <input 
                                class="form-control bg-light shadow-sm" 
                                type="text" 
                                v-model="jugador.dinero"
                                name="dinero" 
                                
                                placeholder="Escriba el monto de dinero del jugador..">
                        </div>
                                
                        <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn btn-link btn-block" href="" @click="cerrar">Cancelar</button>
            
                </form>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {        
        props:['jugador'],
        data(){
            return {                  
            }
        },
        methods:{
            editarJugador(){                                                
                axios.patch(`/jugador/${this.jugador.id}`,this.jugador).then((response)=>{
                    if (response.data.result == "exito"){
                        alert("Exito");
                        this.$emit('closeEdit',false);
                    }
                }).catch(

                );                
            },
            cerrar(){
                this.$emit('closeEdit',false);
            }
        }
    }
</script>