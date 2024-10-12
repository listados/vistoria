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
    <span class="mailbox-read-time">Seus dados são salvo automaticamente</span>
  </div>
</div>
</template>

<script>

import { getSetting } from '../../../helpers/helper';
import {setTimeout} from "../../../../../../public/js/vendor";
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
      console.log('editor change!', quill.root.innerHTML)
      this.$message({
        showClose: true,
        type: 'success',
        message: 'Dados salvo com sucesso!'
      });

    },
    getSetting(){
      this.saveAspectGeneral = false;
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