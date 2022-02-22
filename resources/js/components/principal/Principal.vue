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
                inactiveClass: 'inactive'
            }
        },

        created() {
            const component = this;

            this.handler = function (e) {
                console.log(this.$refs('letra'));
            }
            
            window.addEventListener('keyup', this.handler);
        },

        beforeDestroy() {
            window.removeEventListener('keyup', this.handler);
        },

		mounted: function() {
			
		},

		methods: {
            selectLetter() {
                
            },

            escreve(letra) {
                console.log(this.$refs('letra'));
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
        background: #cdcdcd;
    }

    .inactive {
        background: #F7F7F7;
    }
</style>