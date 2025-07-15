<template>
    <div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ambiente</h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label for="">Cadastrar um ambiente</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ambience_name" id="ambience_name">
                                <span class="input-group-btn">
                                <button type="button" id="btn-save-ambience" class="btn btn-success btn-flat" title="Salva um novo ambiente"> 
                                    <i class="fa fa-save"></i> Salvar
                                </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4><i class="fa fa-info-circle"></i> Aviso!</h4>                
                                <p>Quando editar um ambiente, todas os laudos que usam o ambiente será alterado.</p>
                               
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <!-- <table id="table-ambience" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                        </table> -->
                                        <el-table
    :data="ambiente"
    stripe
    style="width: 100%">
    <el-table-column
      prop="ambience_name"
      label="Nome">
    </el-table-column>
<el-table-column
      fixed="right"
      label="Ação">
      <template slot-scope="scope">
       <el-button type="primary" @click="openEditDialog(scope.row)"
        icon="el-icon-edit" circle
       ></el-button>
      </template>
    </el-table-column>
  </el-table>

  <el-dialog
  title="Alterar Ambiente"
  :visible.sync="dialogVisible">
  <span>Ao editar um ambiente, outras vistorias podem ter o nome do ambiente alterado.</span>
  <p>
    <el-input placeholder="Please input" v-model="input"></el-input>
  </p>
  <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">Cancel</el-button>

    <el-button type="primary" @click="updateAmbiente" icon="el-icon-edit">Alterar</el-button>
  </span>
</el-dialog>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import { component } from '@/composables/component.js'

export default {
    data() {
        return {
            ambiente: null, // Armazena os dados retornados do endpoint
            loading: false, // Controle de estado de carregamento
            error: null, // Armazena possíveis erros
            dialogVisible: false,
            input: '',
            selectedAmbienceId: null
        }
    },
    mounted() {
        this.fetchAmbiente();
    },
    methods: {
        fetchAmbiente() {
            this.loading = true;
            this.error = null;

            axios.get(domain_complet + '/admin/configuracao/get-ambiente')
                .then(response => {
                    this.ambiente = JSON.parse(JSON.stringify(response.data.data));;
                    console.log(response.data.data)
                })
                .catch(error => {
                    this.error = error.message || 'Erro ao carregar os dados do ambiente';
                    console.error('Erro na requisição:', error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        openEditDialog(row) {
            console.log({row})
            this.selectedAmbienceId = row.ambience_id;
            this.input = row.ambience_name; // Preenche o input com o nome atual
            this.dialogVisible = true;
        },
        updateAmbiente() {
            this.dialogVisible = false
            console.log('updateAmbiente: ' + this.input)
            axios.put('/admin/alter-ambience', {
                ambience_id: this.selectedAmbienceId,
                ambience_name: this.input
            })
                .then(response => {
                    this.$message.success('Ambiente atualizado com sucesso!');
                    this.dialogVisible = false;
                    this.fetchAmbiente(); // Recarrega os dados
                })
                .catch(error => {
                    this.$message.error('Erro ao atualizar o ambiente');
                    console.error('Erro na requisição:', error);
                });
        }
    }
}
</script>

<style lang="scss" scoped>

</style>