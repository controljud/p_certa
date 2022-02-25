<template>
	<div class="container" style="margin-top: 25px;">
        <div class="conteudo">
            <div class="linhas" v-for="indey in tentativas" :key="indey">
                <div v-for="index in tamanho" :key="index" class="letra inactive" @click="selectLetter()"></div>
            </div>
        </div>

        <!--div class="teclas_teclado">
            <div class="row center">
                <div class="teclado">Q</div>
                <div class="teclado">W</div>
                <div class="teclado">E</div>
                <div class="teclado">R</div>
                <div class="teclado">T</div>
                <div class="teclado">Y</div>
                <div class="teclado">U</div>
                <div class="teclado">I</div>
                <div class="teclado">O</div>
                <div class="teclado">P</div>
            </div>
            <div class="row center">
                <div class="teclado">A</div>
                <div class="teclado">S</div>
                <div class="teclado">D</div>
                <div class="teclado">F</div>
                <div class="teclado">G</div>
                <div class="teclado">H</div>
                <div class="teclado">J</div>
                <div class="teclado">K</div>
                <div class="teclado">L</div>
            </div>
            <div class="row center">
                <div class="teclado">Z</div>
                <div class="teclado">X</div>
                <div class="teclado">C</div>
                <div class="teclado">V</div>
                <div class="teclado">B</div>
                <div class="teclado">N</div>
                <div class="teclado">M</div>
            </div>
        </div-->
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
                isActive: 0,

                activeClass: 'active',
                inactiveClass: 'inactive',

                existsClass: 'exists',
                existsExactClass: 'existsExact',
                notExistsClass: 'notExists',

                linhaAtual: 0,
                posicao: 0,

                palavraCerta: 'rampa'
            }
        },

        created() {
            
        },

		mounted: function() {
            window.addEventListener('keyup', this.escreve);
            this.setActiveLine(0);
		},

		methods: {
            setActiveLine(line) {
                if (line <= this.tentativas) {
                    let linhas = document.getElementsByClassName('linhas');

                    let linha = linhas[line].children;

                    if (line > 0) {
                        let linhaAnterior = linhas[(line - 1)].children;

                        for (let i = 0; i < linhaAnterior.length; i++) {
                            linhaAnterior[i].classList.remove(this.activeClass);

                            linhaAnterior[i].classList.add(this.inactiveClass);
                        }
                    }

                    for (let i = 0; i < linha.length; i++) {
                        linha[i].classList.remove(this.inactiveClass);

                        linha[i].classList.add(this.activeClass);
                    }
                }
            },

            escreve(event) {
                if (event.keyCode == 13 && this.linhaAtual < this.tentativas && this.posicao > this.tamanho-1) {
                    this.isActive++;
                    this.setActiveLine(this.isActive);

                    this.posicao = 0;
                    this.linhaAtual++;

                    let letras = new Array;
                    let linhas = document.getElementsByClassName('linhas');
                    let linha = linhas[this.linhaAtual - 1].children;

                    for (let i = 0; i < linha.length; i++) {
                        letras.push(linha[i].innerHTML);
                    }

                    let posicoes = this.conferePalavra(letras);
                    let erros = 0;

                    for (let i = 0; i < posicoes.length; i++) {
                        if (posicoes[i] != -1) {
                            if (posicoes[i] == i) {
                                linha[i].classList.remove(this.inactiveClass);
                                linha[i].classList.add(this.existsExactClass);
                            }

                            if (posicoes[i] != i) {
                                linha[i].classList.remove(this.inactiveClass);
                                linha[i].classList.add(this.existsClass);
                            }
                        } else {
                            erros++;
                            linha[i].classList.remove(this.inactiveClass);
                            linha[i].classList.add(this.notExistsClass);
                        }
                    }

                    if (erros == 0) {

                    }
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
            },

            conferePalavra(letras) {
                let posicoes = new Array;
                let confere = this.palavraCerta.toUpperCase();
                let x = 0;

                for (let i = 0; i < letras.length; i++) {
                    let posicao = confere.indexOf(letras[i]);

                    posicoes.push(posicao);

                    confere = confere.replace(letras[i], '#');
                }

                return posicoes;
            }
		}
	}
</script>

<style>
    .conteudo {
        width: 320px;
        margin: 0 auto;
        display: block;
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

    .exists {
        background: #FFC300;
    }

    .existsExact {
        background: #1B5E20;
    }

    .notExists {
        background: #212121;
    }

    .teclado {
        width: 30px !important;
        height: 30px !important;
        background: #cdcdcd;
        border-radius: 10%;
        margin: 3px;

        text-align: center;
        vertical-align: center;
    }

    .center {
        display: block;
        text-align: center;
    }

    .teclas_teclado {
        width: 320px;
        text-align: center;
        
        display: flex;
    }
</style>