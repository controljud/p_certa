<template>
	<div class="container" style="margin-top: 25px">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row linhas" v-for="indey in tentativas" :key="indey">
                    <div v-for="index in tamanho" :key="index" class="letra" @click="changeColor(this)">{{index}}</div>
                </div>
            </div>
            <div class="col-md-2"></div>
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
                tentativas: 6
            }
        },

		mounted: function() {
			
		},

		methods: {
            changeColor(div) {
                console.log(div);
            }
		}
	}
</script>

<style>
    .letra {
        float: left;
        border: 1px solid #696969;
        width: 35px !important;
        height: 35px;
        border-radius: 5px;
        margin: 5px;

        text-align: center;
        vertical-align: center;
        font-size: 12px;
    }
</style>