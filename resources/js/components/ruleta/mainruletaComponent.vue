<template>
        <div class="container">
            <div class="row shadow">                
                <div class="col-12 col-sm-10 col-lg-10 mx-auto mb-4">
                    <h2 class="mt-3">My Ruleta</h2>
                    <br>                    
                    <h3>Usuario: {{nombreJugador}}, Saldo: $ {{dinero}}</h3>
                    <hr>                                        
                    <div class="form-group" v-if="allin">
                        <label for="porcentaje">Selecciones un porcentaje de dinero que quiera aportar: </label>                    
                        <select class="form-select" aria-label="Seleccione una opcion" v-model="porcentajeapuesta"
                                @change="ronda($event)">
                            <option selected>Open this select menu</option>
                            <option value="11">11%</option>
                            <option value="12">12%</option>
                            <option value="13">13%</option>
                            <option value="14">14%</option>
                            <option value="15">15%</option>
                            <option value="16">16%</option>
                            <option value="17">17%</option>
                            <option value="18">18%</option>
                            <option value="19">19%</option>
                        </select>
                    </div>
                    <div >
                        <h4>Valor de su apuesta: {{valorApuesta}}</h4>                                        
                    </div>                                                                
                    <hr>                                                            
                    <div>
                        <p>Seleccione el color de su apuesta:</p>
                        <button class="btn btn-success" @click="probabilidad=1; color='Verde'">Verde 1%</button>
                        <button class="btn btn-danger" @click="probabilidad=49.5; color='Rojo'">Rojo 49.5%</button>
                        <button class="btn btn-dark" @click="probabilidad=49.5; color='Negro'" >Negro 49.5%</button>
                        
                        <h4 class="mt-3">Color al que usted le apuesta ! {{color}} ¡</h4>
                    </div>    


                    <div>                        
                        <br>
                        <button class="btn btn-primary " @click="jugar">JUGAR</button>

                        <div>
                            <h2>Resultado : {{colorGanador}}</h2>
                            <h1>¡{{resultado}}!</h1>
                            <h3>Dinero ganado $ {{valorGanado}}</h3>
                        </div>                        
                    
                    </div>    


                </div>
            </div>
        </div>
</template>

<script>


let userAuth = document.head.querySelector('meta[name="user"]'); // captura el usuario autenticado
export default {    
    mounted(){  
        this.consultarJugador();                   
    },
    data(){        
        return {                    
            nombreJugador: "",
            dinero: 0,
            porcentajeapuesta: 0,
            probabilidad : 0,
            valorApuesta : 0,
            color: "",
            colorGanador:"",
            resultado: "",
            valorGanado:0,
            allin:true,         

        }
    },methods:{   
        consultarJugador(){
            axios.get(`jugador/${this.user.id}`).then((response)=>{
                this.nombreJugador = response.data.nombres;
                this.dinero = response.data.dinero;
                this.ronda();
            }).catch();
        },   
        ronda(){            
            if (this.dinero <= 1000){
                this.valorApuesta = this.dinero;
                this.allin = false;
            } else if(this.dinero == 0){
                alert('No puede apostar');
            }
            else {
                this.valorApuesta = ((this.dinero * this.porcentajeapuesta) /100).toFixed(0);
                this.allin = true;
            }            
        },
        jugar(){     
            if (this.valorApuesta != 0) {            
                var numeroRandon = (Math.random()*100).toFixed(1);
                if(numeroRandon<=1) {
                    this.colorGanador = "Verde";
                } else if (numeroRandon<=49.5) {
                    this.colorGanador = "Rojo";
                } else{
                    this.colorGanador = "Negro";  
                }
                
                if (this.color == this.colorGanador){
                    if (this.colorGanador=="Rojo" || this.colorGanador=="Negro"){
                        //console.log('Recupera el doble de lo apostado');
                        this.resultado = "¡Ganas el Doble!"
                        this.valorGanado = this.valorApuesta *2;
                        this.dinero = this.dinero + this.valorGanado;

                        this.valorApuesta = 0;
                        this.porcentajeapuesta = 0;
                        this.color = "";                        
                        this.ronda();
                    } else if(this.colorGanador == "Verde"){
                        //console.log('Recupera 10 veces mas de lo apostado');
                        this.resultado = "¡Ganas 10 Veces Más!";
                        this.valorGanado = this.valorApuesta *10;
                        this.dinero = this.dinero + this.valorGanado;

                        this.valorApuesta = 0;
                        this.porcentajeapuesta = 0;
                        this.color = "";                        
                        this.ronda();
                    }
                }else {
                    //console.log('Ha perdido');
                    this.resultado = "¡Has Perdido :(!";         
                    this.valorGanado = 0;   
                    this.dinero = this.dinero - this.valorApuesta;
                    this.valorApuesta = 0;
                    this.porcentajeapuesta = 0;
                    this.color = "";                    
                    this.ronda();    
                }
                this.guardarDineroGanado();
            }else {
                alert('No tienes dinero apostado')
            }
        },
        guardarDineroGanado(){
            let jugador = {
                "dinero" : this.dinero
            };

            axios.patch(`/jugadorUdinero/${this.user.id}`, jugador).then((response)=>{
                console.log(response)
            });
        }
    },
    computed: {
        user(){ // optiene el usuario autenticado para verificar                        
            return JSON.parse(userAuth.content);
        }
    }
}
</script>