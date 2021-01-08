<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Usuário de Arquivos</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Criar</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="group">Grupo</label>
                                    <v-select
                                            name="group"
                                            label="name"
                                            @input="updateGroup"
                                            :value="item.group"
                                            :options="companiesAll"
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            placeholder="Entre com primeiro nome"
                                            :value="item.name"
                                            @input="updateName"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            placeholder="Enter Email"
                                            :value="item.email"
                                            @input="updateEmail"
                                            >
                                </div>
                            </div>

                            <div class="box-footer">
                                <vue-button-spinner
                                        class="btn btn-primary btn-sm"
                                        :isLoading="loading"
                                        :disabled="loading"
                                        >
                                    Save
                                </vue-button-spinner>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            // Code...
        }
    },
    computed: {
        ...mapGetters('UserFileSingle', ['item', 'loading', 'companiesAll'])
    },
    created() {
        this.fetchCompaniesAll()
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('UserFileSingle', ['storeData', 'resetState', 'setGroup', 'setName', 'setEmail', 'fetchCompaniesAll']),
        updateGroup(value) {
            this.setGroup(value)
        },
        updateName(e) {
            this.setName(e.target.value)
        },
        updateEmail(e) {
            this.setEmail(e.target.value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'user-file.index' })
                    this.$eventHub.$emit('create-success')
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    }
}
</script>


<style scoped>

</style>
