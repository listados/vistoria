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
                console.log({res})
                this.editorData = res.data.survey_provisions
            })
            .catch( (err) =>{
                console.log({err})
            })
        },
        alterField(evt) {
            // console.log(evt);
            // console.log(this.editorData)
            var dataField = {survey_id : this.idSurvey }
            dataField[this.context] = this.editorData
            console.log({dataField})
            axios.put(domain_complet + 'api/survey/content', dataField)
            .then( (res) => {
                console.log({res})
                this.$message({
                    message: 'Valor foi salvo.',
                    type: 'success'
                });

            })
            .catch( (err) =>  {
                console.log({err})
            })
            
        },
        
    }
}
</script>
<style lang="">
    
</style>