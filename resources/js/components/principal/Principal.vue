<template>
	<div class="container" style="margin-top: 25px;">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-warning btn-sm" @click="zerarCache()">Zerar cache (temporário)</button>
            </div>
        </div>
        <div class="conteudo">
            <div class="linhas" v-for="indey in tentativas" :key="indey">
                <div v-for="index in tamanho" :key="index" class="letra inactive"></div>
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
    import {api} from './../../config';

	export default {
		components: {
            
		},

		data() {
            return {
                tamanho: 5,
                tentativas: 6,

                activeClass: 'active',
                inactiveClass: 'inactive',

                existsClass: 'exists',
                existsExactClass: 'existsExact',
                notExistsClass: 'notExists',

                linhaAtual: 0,
                posicao: 0,

                palavraCerta: '',
                letrasJogadas: new Array,
                posicoes: new Array
            }
        },

		mounted: function() {
            axios.get(api.palavraCerta).then(response => {
                this.palavraCerta = response.data.data.palavraCerta;

                this.setPosicoesCache();
            });

            window.addEventListener('keyup', this.escreve);
            this.setActiveLine(0);
		},

		methods: {
            setActiveLine(line) {
                if (line < this.tentativas) {
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
                    this.linhaAtual++;
                    this.setActiveLine(this.linhaAtual);

                    this.posicao = 0;

                    let letras = new Array;
                    let linhas = document.getElementsByClassName('linhas');
                    let linha = linhas[this.linhaAtual - 1].children;

                    for (let i = 0; i < linha.length; i++) {
                        letras.push(linha[i].innerHTML);
                    }

                    this.conferePalavra(letras);

                    this.letrasJogadas += letras.join(',') + '|';
                    localStorage.setItem('letrasJogadas', this.letrasJogadas);

                    for (let i = 0; i < this.posicoes.length; i++) {
                        if (this.posicoes[i] != -1) {
                            if (this.posicoes[i] == i) {
                                linha[i].classList.remove(this.inactiveClass);
                                linha[i].classList.add(this.existsExactClass);
                            }

                            if (this.posicoes[i] != i) {
                                linha[i].classList.remove(this.inactiveClass);
                                linha[i].classList.add(this.existsClass);
                            }
                        } else {
                            linha[i].classList.remove(this.inactiveClass);
                            linha[i].classList.add(this.notExistsClass);
                        }
                    }

                    this.verificaJogo();
                }

                if (this.linhaAtual < this.tentativas) {
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
            },

            conferePalavra(letras) {
                let confere = this.palavraCerta.toUpperCase();
                let x = 0;

                for (let i = 0; i < letras.length; i++) {
                    let posicao = confere.indexOf(letras[i]);

                    this.posicoes.push(posicao);

                    confere = confere.replace(letras[i], '#');
                }
            },

            setPosicoesCache() {
                if (localStorage.getItem("letrasJogadas") != null) {
                    this.letrasJogadas = localStorage.getItem("letrasJogadas");

                    let linhas = document.getElementsByClassName('linhas');
                    
                    let letrasJogadas = this.letrasJogadas.split('|');
                    for (let i = 0; i < letrasJogadas.length; i++) {
                        if (letrasJogadas[i] != '') {
                            let letras = letrasJogadas[i].split(',');
                            let linha = linhas[this.linhaAtual].children;
                            
                            for (let j = 0; j < letras.length; j++) {
                                linha[j].innerHTML = letras[j];
                            }

                            this.conferePalavra(letras);

                            for (let k = 0; k < this.posicoes.length; k++) {
                                if (this.posicoes[k] != -1) {
                                    console.log('Aqui');
                                    if (this.posicoes[k] == k) {
                                        linha[k].classList.remove(this.inactiveClass);
                                        linha[k].classList.add(this.existsExactClass);
                                    }

                                    if (this.posicoes[k] != k) {
                                        linha[k].classList.remove(this.inactiveClass);
                                        linha[k].classList.add(this.existsClass);
                                    }
                                } else {
                                    console.log('Eu hein');
                                    linha[k].classList.remove(this.inactiveClass);
                                    linha[k].classList.add(this.notExistsClass);
                                }
                            }

                            if (this.linhaAtual < this.tentativas) {
                                this.linhaAtual++;

                                this.setActiveLine(this.linhaAtual);
                            }
                        }
                    }

                    this.verificaJogo();
                }
            },

            zerarCache() {
                localStorage.setItem('letrasJogadas', '');
                this.$toast.success("Cache limpo com sucesso");
            },

            verificaJogo() {
                let erros = 0;
                for (let i = 0; i < this.posicoes.length; i++) {
                    if (this.posicoes[i] != i) {
                        erros++;
                    }
                }

                if (erros == 0) {
                    this.$toast.success("Você ganhou, que bom!!!");
                } else {

                }
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