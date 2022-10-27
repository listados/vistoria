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
            <template slot-scope="scope">
                <a :href="urlExternalImg + scope.row.files_name" :download="scope.row.files_name">
                <img :src="urlExternalImg + scope.row.files_name"/>
                </a>    
            </template>
        </el-table-column>
        <el-table-column
            fixed="right"
            label="Ação"
            width="120">
            <template slot-scope="scope">
                <el-button  type="text" size="small">Excluir</el-button>
                <el-button type="text" @click="downloadFile(scope.row)" size="small">Baixar</el-button>
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
            tableData: [],
            urlExternalImg: ''
        }
    },
    created() {
        this.getFiles(this.idProposal, this.type);
        this.urlExternalImg = 'http://172.21.0.2/img/upload/';
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
        },
        downloadFile(row) {
            console.log({row})
            var crypt = btoa(row.files_name)
            axios.get(domain_complet + 'escolha-azul/download-file/'+row.files_id_proposal+'/'+crypt)
            .then( (res) =>{
                console.log(res)
            })
            .catch( (err) => {
                console.log(err)
            })
        }
    },
}
</script>
<style lang="">
    
</style>