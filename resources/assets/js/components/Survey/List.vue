<template>
    <div>
    <el-table
      :data="tableData.filter(data => !this.search || data.survey_address_immobile.toLowerCase().includes(this.search.toLowerCase()))"
      v-loading="loading" 
      style="width: 100%"
      height="600"
      empty-text="Nenhum registro encontrado">
      <el-table-column
        prop="survey_code"
        label="Código"
        width="80">
      </el-table-column>
      <el-table-column
        prop="survey_address_immobile"
        label="Imóvel"
        >
      </el-table-column>
      <el-table-column
        prop="survey_date"
        label="Data"
        width="90">
      </el-table-column>
      <el-table-column
        prop="survey_type_immobile"
        label="Tipo"
        width="120">
      </el-table-column>
      <el-table-column
        prop="survey_inspetor_name"
        label="Vistoriador"
        width="120">
      </el-table-column>
      <el-table-column
        prop="survey_status"
        label="Status"
        width="80">
      </el-table-column>
      
      <el-table-column
        fixed="right"
        width="200">
        <template slot="header" slot-scope="scope">
            <el-input
            v-model="search"
            size="mini"
            placeholder="Buscar endereço"/>
        </template>
        <template slot-scope="scope">
            <el-button
                @click="editSurvey(scope.row)" circle
                type="default" size="small" 
                icon="el-icon-edit-outline" title="Editar Vistoria">
            </el-button>
            <el-button 
               @click="printSurvey(scope.row)" type="default" 
                size="small" icon="el-icon-printer"
                title="Imprimir vistoria" circle>
            </el-button>
            <el-button 
                type="default" size="small"
                icon="el-icon-document-copy" title="Clonar Vistoria"
                circle>
            </el-button>
            <el-button 
                type="default" size="small"
                icon="el-icon-picture-outline" title="Visualizar Imagens" 
                @click="imagensSurvey(scope.row)" circle>
            </el-button>
            <el-button 
                type="default" size="small"
                icon="el-icon-time" title="Histórico" 
                @click="historySurvey(scope.row)" circle>
            </el-button>
            <el-button 
                type="danger" size="small"
                icon="el-icon-delete-solid" title="Excluir Vistoria"
                @click="openDeleteSurvey(scope.row)" circle>
            </el-button>
        </template>
      </el-table-column>
    </el-table>
    </div>
  </template>
<script>

export default {
    data() {
      return {
        tableData: [],
        search: '',
        loading: false
      }
    },
    created() {
        this.getListSurvey();       
    },
    mounted() {
      this.$eventBus.$on('search-survey', this.searchSurvey);
    },
    beforeDestroy() {
        this.$eventBus.$off('search-survey');
    },
    methods: {
      searchSurvey(params) 
      {
        this.loading = true;
          axios.post(domain_complet + 'api/survey/search', params)
          .then( (res) => {
            this.tableData = res.data.message
            this.loading = false
          })
          .catch( (err) => {
            console.log(err)
          });
      },
      getListSurvey() {
        axios.get(domain_complet + 'api/survey/all')
        .then( (res) => {
            this.tableData = res.data
        })
        .catch( (err) => {
            console.log({err})
        } )
      },
      editSurvey(row){
        var idSurvey = btoa(row.survey_id);
        window.open(domain_complet +'vistoria/' + idSurvey + '/editar/Editar-Vistoria/acao' , '_blank')
      },
      printSurvey(row){
        window.open(domain_complet +'vistoria/imprimir?id_survey='+row.survey_id + '&imprimir_com_foto=true' , '_blank')
      },
      imagensSurvey(row){
        var idSurvey = btoa(row.survey_id);
        window.open(domain_complet +'vistoria/'+ idSurvey + '/download' , '_blank')
      },
      historySurvey(row){
        window.open(domain_complet +'vistoria/historico/'+ row.survey_id, '_blank')
      },
      openDeleteSurvey(row) {          
          this.$confirm('Deseja realmente excluir essa vistoria?', 'Excluir Vistoria', {
            confirmButtonText: 'Sim, quero excluir',
            cancelButtonText: 'Não',
            type: 'error',
            cancelButtonClass: 'margin-5'
          }).then((res) => {
            axios.delete(domain_complet + 'api/survey/destroy/' + row.survey_id)
            .then( (response) => {
              this.$message({
                type: 'success',
                message: response.data.message
              });
              this.getListSurvey()
            })
            .catch( (error) => {
              this.$message({
                type: 'error',
                message: error.response.data.message
              });
            })
          });
      },
      searchData(dataTable, query) {
        console.log({dataTable});
        console.log({query})
        return dataTable.filter(data => !this.search || `data.${query}.toLowerCase().includes(search.toLowerCase())`)
      }
    }
}
</script>
<style lang="">
    .el-button+.el-button, .el-checkbox.is-bordered+.el-checkbox.is-bordered {
        margin-left: inherit !important;
        margin-bottom: 5px;
    }
</style>