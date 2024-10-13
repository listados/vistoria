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
      // Buscando da api os dados de configuração
      const res = await getSetting();
      this.content = res.data.settings_aspect_general;
    } catch (error) {
      console.error('Erro ao carregar os usuários:', error);
    }
  },
  methods: {
    onEditorBlur(quill) {
      const length = quill.getLength();
      // Validando para não ser enviado vazio
      if(length == 1){
        this.$message({
          showClose: true,
          type: 'error',
          message: 'O Campo é obrigatório'
        });
        return false;
      }else{
        // Enviando dados para o metodo
        this.settingChange(quill.root.innerHTML);
      }
    },
    // Realizando alteração dos dados enviados
    settingChange(quill){
      const res = alterSetting(quill);
      res.then(resposta => {
        if(resposta.status == 422) {
          this.$message({
            showClose: true,
            type: 'error',
            message: resposta.response.data.errors.settings_aspect_general[0]
          });
          return false;
        }else{
          this.$message({
            showClose: true,
            type: 'success',
            message: 'Dados salvo com sucesso!'
          });
        }
      }).catch(err => {
        this.$message({
          showClose: true,
          type: 'error',
          message: 'Ocorreu um erro inesperado'
        });
      })
    }

  },
  computed: {
  },

}
</script>

<style >

</style>