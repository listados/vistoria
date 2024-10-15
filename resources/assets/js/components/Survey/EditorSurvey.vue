<template>
<div>
  <quill-editor
      :content="content"
      :options="editorOption"
      @blur="alterField($event)"
  />
</div>
</template>

<script>
export default {
  props: {
    idSurvey : String,
    contentSurvey: String,
    context: String
  },
  data () {
    return {
      contentHtml : '',
      content: '',
      editorOption: {
        // Some Quill options...
      }
    }
  },
  created() {
    console.log(this.idSurvey)
    this.getContext();
  },
  methods: {
    getContext() {
      axios.get(domain_complet + 'api/survey/content/id/'+this.idSurvey+'/field/'+this.context)
          .then( (res) => {
            this.content = res.data[this.context]
          })
          .catch( (err) =>{
            console.log({err})
            this.$message({
              message: 'Aconteceu um erro inesperado.',
              type: 'error'
            });
          })
    },
    alterField(quill) {
      // console.log(evt);
      var dataField = {survey_id : this.idSurvey }
      dataField[this.context] = quill.root.innerHTML
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

<style>

</style>