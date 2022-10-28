<template lang="">
    <div>       
    <el-table
    :data="tableData.filter(data => !this.search || data.proposal_name.toLowerCase().includes(this.search.toLowerCase()))"
    style="width: 100%"
    :default-sort = "{prop: 'proposal_id', order: 'descending'}">
    <el-table-column
      prop="proposal_id"
      label="Nº Prop."
      width="80">
    </el-table-column>
    <el-table-column
      prop="completed"
      label="Conclusão"
      width="110"
      sortable>
    </el-table-column>
    <el-table-column
      prop="proposal_name"
      label="Nome"
      >
    </el-table-column>
    <el-table-column
      prop="name"
      label="Atend."
      width="130">
      <template slot-scope="scope">
        <el-button type="text" 
        @click="showModalAtendent(scope.row)">
        {{ scope.row.name.slice(0, 15) }}...
      </el-button>
      </template>
    </el-table-column>
    <el-table-column
      prop="proposal_email"
      label="E-mail"
      >
    </el-table-column>
    <el-table-column
      prop="proposal_status"
      label="Status"
      width="80">
    </el-table-column>
    <el-table-column
      fixed="right"
      width="180">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Pesquise pelo nome"/>
      </template>
      <template slot-scope="scope">
        <el-button @click="redirectProposal('proposal', scope.row)" 
        type="text"
        title="Visualizar proposta"
        size="small">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </el-button>
        <el-button @click="redirectProposal('analysis', scope.row)"
        type="text"
        size="small"
        title="Visualizar análise">
            <i class="fa fa-pie-chart" aria-hidden="true"></i>
        </el-button> 
        <el-button
        type="text"
        size="small"
        v-if="scope.row.files_id > 0"
        @click="redirectProposal('proposal_pf', scope.row)"
        title="Existe arquivos enviados">
            <i class="fa fa-download" aria-hidden="true"></i>
        </el-button>
        <el-button type="text" 
          size="small"  
          @click="openDeleteAgent(scope.row)"
          style="color: red"
          title="Excluir Proposta" 
        >
            <i class="fa fa-trash" aria-hidden="true"></i>
        </el-button>
      </template>
    </el-table-column>
     
  </el-table>
  <el-pagination
        background
        layout="prev, pager, next"
        :total="this.tableData.length"
        @current-change="setPage">
      </el-pagination>
  <el-dialog
  title="Alterar Atendente"
  :visible.sync="dialogVisible"
  width="30%">
  <span>Você tem que selecionar um atendente para ser o <br/> responsável por essa proposta.</span>
  <el-select v-model="value" 
  placeholder="-- Selecione um agente --" 
  size="large" 
  @change="updateDropdowns">
    <el-option
      v-for="item in options"
      :key="item.value"
      :label="item.label"
      :value="item.value">
    </el-option>
  </el-select>
  <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">Sair</el-button>
  </span>
</el-dialog>
</div>
</template>
<script>
export default {
    props: {
        atendent: Array
    },
    data() {
        return {
            tableData: [],
            search: '',
            dialogVisible: false,
            options: [],
            value: '',
            idProposal: 0
        }
    },
    created() {
        this.getProposalPF()
        this.options = this.atendent
   },
    methods: {
        getProposalPF() {
            axios.get(domain_complet + 'escolha-azul/getProposalPF')
            .then(response =>{
              var listProposal = [];//lista de array com as propostas
              var countProposal = 0;//contador inicial
                //laço para criar um array de objeto com ordem de index
                for (const [key, value] of Object.entries(response.data)) {
                  listProposal[countProposal] = value;//inserindo o objeto no array
                  countProposal++;//incremento para proximo objeto
                }
                console.log(listProposal.sort())
                this.tableData = listProposal.sort()
            })
        },
        searchData(dataTable, query) {
            console.log({ query })
            return dataTable.filter(data => !this.search || `data.${query}.toLowerCase().includes(search.toLowerCase())`)
        },
        redirectProposal(index, row) {
          var url = ''
          switch (index) {
            case 'proposal':
              // url = domain_external + '?action=view-proposal&id=' + btoa(row.proposal_id)
              url = domain_complet + 'escolha-azul/pdf-pf/'+row.proposal_id+'/'+index
              break;
            case 'analysis':
              url = 'view/report/proposal_pf_adm.php?id=' + btoa(row.proposal_id)            
              break;
            case 'proposal_pf':
              url = domain_complet = 'download/' + row.proposal_id +'/'+ index      
              break;
          }
          window.open(url , '_blank');
        },
        updateDropdowns: function (value) {
            // console.log(value);
            // console.log('id proposal' , this.idProposal)
            let data = {proposal_id: this.idProposal, proposal_id_user: value}
            axios.post(domain_complet + 'api/escolha-azul/alter-agent', data)
            .then( (response) => {
              this.$message({
                type: 'success',
                message: response.data.message
              });
              this.getProposalPF()
            })
            .catch( (error) => {
              this.$message({
                type: 'error',
                message: 'Ocorreu um erro inesperado: ' + error.response.data.message
              }); 
            })
            //enviar para alterar a proposta para agente escolhido
        },
        showModalAtendent(row) {
          this.dialogVisible = true
          this.idProposal = row.proposal_id
        },
        openDeleteAgent(row) {          
          this.$confirm('Deseja realmente excluir essa proposta?', 'Excluir Proposta', {
            confirmButtonText: 'Sim, quero excluir',
            cancelButtonText: 'Não',
            type: 'error'
          }).then((res) => {
            axios.delete(domain_complet + 'api/escolha-azul/delete-proposal-pf/' + row.proposal_id)
            .then( (response) => {
              this.$message({
                type: 'success',
                message: response.data.message
              });
              this.getProposalPF()
            })
            .catch( (error) => {
              this.$message({
                type: 'error',
                message: error.response.data.message
              });
            })
          });
        },
        setPage (val) {
          console.log({val})
          this.page = val
        }
    }
}
</script>
<style lang="">
    .el-select--large  {
        width: 100%
    }
    .el-dialog__body {
        text-align: center;
    }
</style>