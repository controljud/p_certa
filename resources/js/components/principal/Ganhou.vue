<template>
    <div>
        <b-modal id="ganhouModal" hide-footer hide-header-close>
            <template #modal-title>Ganhou!</template>
            <div class="d-block text-left">

                <b-button type="button" variant="secondary" block @click="register">
					<i class="fas fa-sign-in-alt"></i> Fechar
				</b-button>
            </div>
        </b-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        },

        methods: {
            
        }
    }
</script>