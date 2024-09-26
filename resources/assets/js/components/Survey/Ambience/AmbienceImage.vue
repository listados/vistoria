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
                            <input type="checkbox" name="surveyAlter[]" title="Alterar Ambiente"
                                :value="img.files_ambience_id" v-model="selectedAlterAmbience" />
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
                            <a href="#" class="btn btn-info pull-right" @click="alterImage">
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
        <!--MODAL-->
        <div class="modal fade" id="alter-ambience" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Alterar Ambientesss</h4>
                    </div>
                    <div class="modal-body">


                        <h3 class="text-info">Escolha o ambiente da Imagem.</h3>
                        
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" v-model="selectedOptionAmbience">
                                <option value="">--Selecione--</option>
                                <option v-for="item in optionsSelect" :value="item.ambience_id">{{item.ambience_name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                        <button type="button" class="btn btn-primary" @click="imageAlterAmbience">Alterar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--FIM MODAL-->

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
            selectedAlterAmbience: [],
            optionsSelect: [],
            selectedOptionAmbience: Number
        }
    },
    created() {
        //Chamando função
        this.getAmbience();
        this.allAmbience();
    },
    methods: {
        //Iniciando todas as imagens
        getAmbience() {
            axios.get(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/files_ambience/show/' + this.idSurvey)
            .then(res => {
                this.images = res.data
            })
        },
        allAmbience() {            
            axios.get(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/ambience-all/')
            .then(res => {
                console.log({res})
                this.optionsSelect = res.data
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
        },
        alterImage() {
            if (this.selectedAlterAmbience.length == 0) {
                this.$message({
                    title: 'Ops!',
                    showClose: true,
                    type: 'error',
                    message: 'Para alterar, você precisa selecionar pelo menos uma imagem.',
                    offset: 40
                });
                return false
            }
           
            $('#alter-ambience').modal('show');

        },
        imageAlterAmbience() {
            const dataPost = {
                surveyAlter: this.selectedAlterAmbience,
                files_ambience_id_ambience: this.selectedOptionAmbience
            }
            axios.post(process.env.MIX_SENTRY_DSN_PUBLIC + '/api/alter-delete-ambience', dataPost)
                .then(res => {
                    if (res.status == 200) {
                        this.$message({
                            showClose: true,
                            type: 'success',
                            message: res.data.message
                        });
                        //Ajustando ambiente atual
                        this.getAmbience();
                        //ocutando modal
                        $('#alter-ambience').modal('hide');
                    }
                })
                .catch(err => {
                    this.$message({
                        type: 'error',
                        message: 'Ocorreu um erro inesperado.'
                    });
                })
        }
        
    }
}
</script>

<style></style>