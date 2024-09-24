<template>
    <div>
        <div class="table-responsive box">
            <table class="table table-bordered" id="table-ambience-survey">
                <thead>
                    <tr>
                        <th>Ambiente</th>
                        <th>Arquivo</th>
                        <th>Alterar Ambiente</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="img in images" :key="img.id">
                        <td>{{ img.ambience_name }}</td>
                        <td style="width: 50%;">
                            <a href="#" class="thumbnail">
                                <img :src="route + img.files_ambience_description_file">
                            </a>
                        </td>
                        <td>
                            <input type="checkbox" name="surveyAlter[]" title="Alterar Ambiente" value="" />
                        </td>
                        <td>
                            <input type="checkbox" name="surveyDelete[]" title="Excluir Ambiente"
                                :value="img.files_ambience_id" v-model="selectedDelete" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered box-footer">
                    <tr>
                        <th>Ambiente</th>
                        <th>Arquivo</th>
                        <th>
                            <a href="#" data-toggle="modal" data-target="#alter-ambience" id="alter-ambience-btn"
                                class="btn btn-info pull-right">
                                Alterar
                            </a>
                        </th>
                        <th>
                            <a href="#" id="" class="btn btn-danger pull-right" @click="deleteImage">Excluir
                            </a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        idSurvey: Number
    },
    data() {
        return {
            images: [],
            route: process.env.MIX_SENTRY_DSN_PUBLIC + '/dist/img/upload/vistoria/',
            selectedDelete: [],
        }
    },
    created() {
        //Chamando função
        this.getAmbience();
    },
    methods: {
        //Iniciando todas as imagens
        getAmbience() {
            axios.get(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/files_ambience/show/' + this.idSurvey)
            .then(res => {
                this.images = res.data
            })
        },
        deleteImage() {
            //Retorno de informação
            if (this.selectedDelete.length == 0) {
                this.$message({
                    title: 'Ops!',
                    showClose: true,
                    type: 'error',
                    message: 'Para exclusão, você precisa selecionar pelo menos uma imagem.',
                    offset: 40
                });
                return false
            }
            //Dados para o controller
            const dataPost = {
                surveyDelete: this.selectedDelete
            }
            this.$confirm('Deseja realmente fazer essa exclusão?', 'Ops!', {
                confirmButtonText: 'Excluir',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                axios.post(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/alter-delete-ambience', dataPost)
                .then(res => {
                    if (res.status == 200) {
                        this.$message({
                            showClose: true,
                            type: 'success',
                            message: res.data.message
                        });
                        this.getAmbience();
                    }
                })
                .catch(err => {
                    this.$message({
                        type: 'error',
                        message: 'Ocorreu um erro inesperado.'
                    });
                })
            });
        }
    }
}
</script>

<style></style>