<template>
<div>
  <div class="box-body">
  <quill-editor
      :content="content"
      :options="editorOption"
      @blur="onEditorBlur($event)"
  />

  </div>
  <div class="box-footer text-center" >
    <span class="mailbox-read-time">Seus dados são salvo automaticamente.</span> <br>
    <span class="mailbox-read-time">Deve conter no mínimo 5 caracteres.</span>
  </div>
</div>
</template>

<script>

import { getSetting, alterSetting } from '../../../helpers/helper';
export default {
  data () {
    return {
      contentHtml : '',
      content: '',
      editorOption: {
        // Some Quill options...
      }
    }
  },
  async created() {
    try {
      const res = await getSetting();
      this.content = res.data.settings_aspect_general;
    } catch (error) {
      console.error('Erro ao carregar os usuários:', error);
    }
  },
  methods: {
    onEditorBlur(quill) {
      const length = quill.getLength();
      // if(length == 1){
      //   this.$message({
      //     showClose: true,
      //     type: 'error',
      //     message: 'O Campo é obrigatório'
      //   });
      //   return false;
      // }else{
      //   alterSetting(quill.root.innerHTML);
      // }
      const res = alterSetting(quill.root.innerHTML);
      res.then(res => {
        console.log(res)
      }).catch(err => {
        console.log({err})
      })
      this.$message({
        showClose: true,
        type: 'success',
        message: 'Dados salvo com sucesso!'
      });

    }

  },
  computed: {
    editor() {
      // return this.$refs.myQuillEditor.quill
    }
  },
  mounted() {
    console.log('this is current quill instance object', this.editor)
  }
}
</script>

<style >

</style>