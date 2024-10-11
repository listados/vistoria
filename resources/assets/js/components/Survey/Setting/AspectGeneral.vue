<template>
<div>
  <quill-editor
      v-model="content"
      :options="editorOption"
      @blur="onEditorBlur($event)"
  />
  <div>
    <br>
  </div>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
        <strong>Como irá ficar na vistoria:</strong>
      </h3>
      <div class="box-body">
        <div v-html="content"></div>
      </div>
    </div>
  </div>

</div>
</template>

<script>
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
  created() {
    //Chamando função
    this.content = '<p><strong>Caracter&iacute;sticas do im&oacute;vel</strong>: Apartamento com Sala, 3 quartos com arm&aacute;rios (sendo 1 su&iacute;te com box), banheiro social com box, cozinha com arm&aacute;rios, &aacute;rea de servi&ccedil;o. Ambientes: Sala, Quarto 01, Quarto 02, Su&iacute;te, WC Su&iacute;te, WC Social, Cozinha e &Aacute;rea de Servi&ccedil;o.</p>\n' +
        '\n' +
        '<p><strong>Faxinado</strong>: Sim</p>\n' +
        '\n' +
        '<p><strong>Mobiliado</strong>: N&atilde;o, mas com arm&aacute;rios fixos de madeira em todos os quartos, na cozinha e na &aacute;rea de servi&ccedil;o. &nbsp;</p>\n' +
        '\n' +
        '<p><strong>Piso</strong>: Porcelanato branco, exceto nos banheiros que &eacute; cer&acirc;mica.</p>\n' +
        '\n' +
        '<p><strong>Paredes</strong>: Pintura em l&aacute;tex na cor creme, exceto nos banheiros e na cozinha que &eacute; cer&acirc;mica.</p>\n' +
        '\n' +
        '<p><strong>Teto</strong>: Pintura em l&aacute;tex na cor branco neve, exceto no banheiro que s&atilde;o forrados em PVC.</p>\n' +
        '\n' +
        '<p><strong>Portas e Portais</strong>: Entrada da sala com 02 portas e 02 portais, sendo a primeira em alum&iacute;nio e a segunda de madeira, ambas com fechaduras; entrada da cozinha tamb&eacute;m com 02 portas e 02 portais, sendo a primeira em alum&iacute;nio e a segunda de madeira, ambas com fechaduras; portal e porta dos quartos e dos banheiros com porta modelo sanfonada em PVC, todas com trava.</p>\n' +
        '\n' +
        '<p><strong>Instala&ccedil;&atilde;o hidr&aacute;ulica:</strong> Em perfeito funcionamento, sem ressalvas.</p>\n' +
        '\n' +
        '<p><strong>Instala&ccedil;&atilde;o el&eacute;trica:</strong> Em perfeito funcionamento, sem ressalvas.</p>\n';
  },
  methods: {
    onEditorBlur({ quill, html, text }) {
      console.log('editor change!', quill, html, text)
      this.content = html
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