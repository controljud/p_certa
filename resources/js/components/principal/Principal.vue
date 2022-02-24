<template>
	<div class="container" style="margin-top: 25px;">
        <div class="conteudo">
            <div class="linhas" v-for="indey in tentativas" :key="indey">
                <div v-for="index in tamanho" :key="index" class="letra" ref="letra" @click="selectLetter()" v-bind:class="[indey == isActive ? activeClass : inactiveClass]"></div>
            </div>
        </div>
	</div>
</template>

<script>
	export default {
		components: {
			
		},

		data() {
            return {
                tamanho: 5,
                tentativas: 6,
                isActive: 1,

                activeClass: 'active',
                inactiveClass: 'inactive',

                linhaAtual: 0,
                posicao: 0
            }
        },

        created() {
            
        },

		mounted: function() {
            window.addEventListener('keyup', this.escreve);
		},

		methods: {
            handler(event) {
                
            },

            selectLetter() {
                
            },

            escreve(event) {
                if (event.keyCode == 13 && this.linhaAtual < this.tentativas && this.posicao > this.tamanho-1) {
                    this.linhaAtual++;
                    this.posicao = 0;
                    
                    this.isActive++;
                }

                if (event.keyCode == 8 && this.posicao >= 1) {
                    let linhas = document.getElementsByClassName('linhas');
                    let linha = linhas[this.linhaAtual].children;

                    this.posicao--;
                    linha[this.posicao].innerHTML = '';
                }
                
                if (this.posicao < this.tamanho && (event.keyCode >= 65 && event.keyCode <= 90)) {
                    let letra = event.key.toUpperCase();

                    let linhas = document.getElementsByClassName('linhas');
                    let linha = linhas[this.linhaAtual].children;

                    linha[this.posicao].innerHTML = letra;
                    this.posicao++;
                }
            }
		}
	}
</script>

<style>
    .conteudo {
        width: 320px;
        margin: 0 auto;
    }

    .linhas {
        width: 100%;
        display: block;
    }

    .letra {
        width: 60px;
        height: 60px;
        border-radius: 10%;
        margin: 2px;
        float: left;

        font-size: 40px;
        text-align: center;
        vertical-align: center;
        color: white;
    }

    .active {
        background: #696969;
    }

    .inactive {
        background: #cdcdcd;
    }
</style>