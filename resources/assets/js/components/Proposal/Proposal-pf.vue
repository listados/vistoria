<template lang="">
    <div>
       
    <el-table
    :data="tableData"
    style="width: 100%">
    <el-table-column
      prop="proposal_id"
      label="Nº Proposta">
    </el-table-column>
    <el-table-column
      prop="proposal_completed"
      label="Conclusão">
    </el-table-column>
    <el-table-column
      prop="proposal_name"
      label="Nome">
    </el-table-column>
    <el-table-column
      prop="name"
      label="Atend.">
      <template slot-scope="scope">
        <el-button type="text" @click="dialogVisible = true">{{ scope.row.name }} </el-button>
      </template>
    </el-table-column>
    <el-table-column
      prop="proposal_email"
      label="E-mail">
    </el-table-column>
    <el-table-column
      prop="proposal_status"
      label="Status">
    </el-table-column>
    <el-table-column
      fixed="right"
      label="Visualizar"
      width="120">
      <template slot-scope="scope">
        <el-button @click="handleClick(scope.$index, scope.row)" type="text" size="small">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </el-button>
        <el-button type="text" size="small">
            <i class="fa fa-pie-chart" aria-hidden="true"></i>
        </el-button> 
        <el-button type="text" size="small">
            <i class="fa fa-download" aria-hidden="true"></i>
        </el-button>
        <el-button type="text" size="small">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </el-button>
      </template>
    </el-table-column>
  </el-table>
  <el-dialog
  title="Alterar Atendente"
  :visible.sync="dialogVisible"
  width="30%"
  :before-close="handleClose">
  <span>Você tem que selecionar um atendente para ser o responsável por essa proposta.</span>
  <el-select v-model="value" placeholder="-- Selecione um agente --" size="large" @change="updateDropdowns">

    <el-option
      v-for="item in options"
      :key="item.value"
      :label="item.label"
      :value="item.value">
    </el-option>
  </el-select>
  <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">Sair</el-button>
    <el-button type="primary">Alterar</el-button>
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
            value: ''
        }
    },
    created() {
        this.getProposalPF()
        console.log(this.atendent)
        this.options = this.atendent
   },
    methods: {
        getProposalPF() {
            axios.get(domain_complet + 'escolha-azul/getProposalPF')
            .then(response =>{
                console.log('contact', response.data)
                this.tableData = response.data
            })
        },
        searchData(dataTable, query) {
            console.log({ query })
            return dataTable.filter(data => !this.search || `data.${query}.toLowerCase().includes(search.toLowerCase())`)
        },
        handleClick(index, row) {
            console.log('click');
        },
        updateDropdowns: function (value) {
            console.log(value);
            //enviar para alterar a proposta para agente escolhido
        },
        handleClose(done) {
            this.$confirm('Are you sure to close this dialog?')
            .then(_ => {
                done();
            })
            .catch(_ => {});
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