<template>
    <div>
        <el-button 
            class="custom-button"
            @click="alterOrdem"
            size="mini"
            title="Altera a ordem do ambiente no laudo"    
        >Alterar Ordem</el-button>
    </div>
</template>

<script>
export default {
    data() {
    },
    methods: {
        alterOrdem() {
            let list_id_ambience = "";
            //Lista com todos os ids do ambiente
            $('#list-group > li').each(function (index, element) {
                list_id_ambience = list_id_ambience + element.value + ",";
            });
            
            let data = {order_ambience_survey_list_order: list_id_ambience, order_ambience_survey_id_survey: $("#id_survey_ambience").val()}

            axios.post(domain_complet+'api/survey/alter-order/',data)
            .then( (res) => {
               this.$message({
                    showClose: true,
                    type: 'success',
                    message: 'Ordem do ambiente alterado com sucesso'
                });
            })
            .catch( (err)=>{
                this.$message({
                    showClose: true,
                    type: 'error',
                    message: ' Ops! Ocorreu um erro: '+ err.data.message
                });
            })
        }
    }
}
</script>

<style>
.custom-button {
  background-color: #337ab7;
  color: white;
  border-color: #337ab7; /* Para combinar a borda com a cor do botão */
}

.custom-button:hover {
  background-color: #065fad;
  color: white;
  border-color: #337ab7; /* Para combinar a borda com a cor do botão */
}
</style>