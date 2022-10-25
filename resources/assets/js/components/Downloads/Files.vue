<template lang="">
    <div>
        <el-table
        :data="tableData"
        style="width: 100%">
        <el-table-column
            prop="files_date"
            label="Data Envio"
            width="180">
        </el-table-column>
        <el-table-column
            prop="files_name"
            label="Nome Arquivo"
            width="180">
        </el-table-column>
        <el-table-column
            prop="files_name"
            label="Imagem">
        </el-table-column>
        <el-table-column
            fixed="right"
            label="Ação"
            width="120">
            <template slot-scope="scope">
                <el-button  type="text" size="small">Excluir</el-button>
                <el-button type="text" size="small">Baixar</el-button>
            </template>
        </el-table-column>
        </el-table>
    </div>
</template>
<script>

export default {
    props: {
        idProposal : Number,
        type: String
    },
    data() {
        return {
            tableData: []
        }
    },
    created() {
        this.getFiles(this.idProposal, this.type);
    },
    methods: {
        getFiles(id, type ) {
            axios.get(domain_complet + 'api/escolha-azul/download/'+ id + '/type/'+ type)
            .then( (response) =>{
                console.log({response})
                this.tableData = response.data
            })
            .catch( (err) => {

            })
        }
    },
}
</script>
<style lang="">
    
</style>