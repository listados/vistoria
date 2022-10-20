<template lang="">
     <el-table
    :data="tableData.filter(data => !this.search || data.name.toLowerCase().includes(this.search.toLowerCase()))"
    style="width: 100%">
    <el-table-column
      fixed
      prop="date"
      label="Cod Cadastro"
      width="150">
    </el-table-column>
    <el-table-column
      prop="name"
      label="Concluída"
      width="120">
    </el-table-column>
    <el-table-column
      prop="state"
      label="Nome"
      width="120">
    </el-table-column>
    <el-table-column
      prop="city"
      label="CPF"
      width="120">
    </el-table-column>
    <el-table-column
      prop="address"
      label="Nome Proposnente"
      width="300">
    </el-table-column>
    <el-table-column
      prop="zip"
      label="Zip"
      width="120">
    </el-table-column>
    <el-table-column
      fixed="right">
            <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Pesquise"/>
      </template>
      <template slot-scope="scope">
        <el-button @click="handleClick(scope.$index, scope.row)" type="danger" size="small" title="Excluir cadastro">
            <i class="fa fa-trash"></i>
        </el-button>
        <el-button type="dafault" size="small">
            <i class="fa fa-edit"></i>
        </el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
<script>

export default {
    data() {
        return {
            idButton: 0,
            displayValue: '',
            tableData: [],
            search: 'junior',
            name: ''
        }
    },
    beforeMount() {
       this.displayValue = this.params;
   },
   created() {
        this.getCadastre()
   },
    methods: {
        btnClickedHandler() {
            this.params.clicked(this.params.value);
        },
        handleClick(index, row) {
            console.log(index, row);
        },
        getCadastre() {
            axios.get(domain_complet + 'api/escolha-azul/getCadastrePF')
            .then(response =>{
                console.log('contact', response.data)
                this.tableData = response.data
            })
        },
        searchData(dataTable, query) {
            console.log({ query })
            return dataTable.filter(data => !this.search || `data.${query}.toLowerCase().includes(search.toLowerCase())`)
        }
    }
}
</script>
<style lang="">
    
</style>