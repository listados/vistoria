<template lang="">
    <div>
        <ckeditor v-model="editorData" :config="editorConfig" @blur="alterField"></ckeditor>
    </div>
</template>
<script>
export default {
    props: {
        idSurvey : String,
        context: String
    },
    data() {
        return {
            editorData: '',
            editorConfig: {
                // The configuration of the editor.
            }
        }
    },
    created() {
        this.getContext();
    },
    mounted() {

    },
    methods: {
        getContext() {
            axios.get(domain_complet + 'api/survey/content/id/'+this.idSurvey+'/field/'+this.context)
            .then( (res) => {
                this.editorData = res.data[this.context]
            })
            .catch( (err) =>{
                console.log({err})
                this.$message({
                    message: 'Aconteceu um erro inesperado.',
                    type: 'error'
                });
            })
        },
        alterField(evt) {
            // console.log(evt);
            var dataField = {survey_id : this.idSurvey }
            dataField[this.context] = this.editorData
            axios.put(domain_complet + 'api/survey/content', dataField)
            .then( (res) => {
                this.$message({
                    message: 'O Rascunho foi salvo.',
                    type: 'success'
                });

            })
            .catch( (err) =>  {
                console.log({err})
                this.$message({
                    message: 'Aconteceu um erro inesperado.',
                    type: 'error'
                });
            })
            
        },
        
    }
}
</script>
<style lang="">
    
</style>