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
                                <h3 class="box-title">Create</h3>
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
                                    <b-form-file
                                        v-model="file1"
                                        :state="Boolean(file1)"
                                        placeholder="Choose a file or drop it here..."
                                        drop-placeholder="Drop file here..."
                                        ></b-form-file>
                                        <div class="mt-3">Selected file: {{ file1 ? file1.name : '' }}</div>

                                        <!-- Plain mode -->
                                        <b-form-file v-model="file2" class="mt-3" plain></b-form-file>
                                        <div class="mt-3">Selected file: {{ file2 ? file2.name : '' }}</div>
                                    </div>
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
        ...mapGetters('UploadFileSingle', ['item', 'loading', 'companiesAll'])
    },
    created() {
        this.fetchCompaniesAll()
    },
    destroyed() {
        this.resetState()
    },
    methods: {
        ...mapActions('UploadFileSingle', ['storeData', 'resetState', 'setUser', 'setName_file', 'setUrl_file', 'fetchCompaniesAll']),
        updateUser(value) {
            this.setUser(value)
        },
        updateName_file(e) {
            this.setName_file(e.target.value)
        },
        updateSize_file(e) {
            this.setSize_file(e.target.value)
        },
        updateUrl_file(e) {
            this.setUrl_file(e.target.value)
        },
        submitForm() {
            this.storeData()
                .then(() => {
                    this.$router.push({ name: 'upload.index' })
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