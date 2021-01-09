<template>
    <section class="content-wrapper" style="min-height: 960px;">
        <section class="content-header">
            <h1>Upload de Arquivos</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <form @submit.prevent="submitForm">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit</h3>
                            </div>

                            <div class="box-body">
                                <back-buttton></back-buttton>
                            </div>

                            <bootstrap-alert />

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="user">Usuário do arquivo</label>
                                    <v-select
                                            name="user"
                                            label="name"
                                            @input="updateUser"
                                            :value="item.user"
                                            :options="companiesAll"
                                            />
                                </div>
                                <div class="form-group">
                                    <label for="name_file">Nome do arquivo</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="name_file"
                                            placeholder="Enter First name"
                                            :value="item.name_file"
                                            @input="updateName_file"
                                            >
                                </div>
                                <div class="form-group">
                                    <label for="size_file">Last name</label>
                                    <input
                                            type="text"
                                            class="form-control"
                                            name="size_file"
                                            placeholder="Enter Last name"
                                            :value="item.size_file"
                                            @input=" updateSize_file"
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
        ...mapGetters('UploadFileSingle', ['item', 'loading', 'companiesAll']),
    },
    created() {
        this.fetchData(this.$route.params.id)
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('UploadFileSingle', ['fetchData',  'setUser', 'setName_file', 'setSize_file',]),
        updateUser(value) {
            this.setUser(value)
        },
        updateName_file(e) {
            this.setName_file(e.target.value)
        },
        updateSize_file(e) {
            this.setSize_file(e.target.value)
        },
        submitForm() {
            this.updateData()
                .then(() => {
                    this.$router.push({ name: 'upload.index' })
                    this.$eventHub.$emit('update-success')
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
