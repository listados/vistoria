<template lang="">
    <div>
        <ckeditor v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
</template>
<script>
import VueCkeditor from 'vue-ckeditor2';    
export default {
    components: { VueCkeditor },
    data() {
        return {
            content: '',
            config: {
                toolbar: [
                ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
                ],
                height: 300
            },
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                // The configuration of the editor.
            }
        }
    },
    methods: {
        onBlur(evt) {
        console.log(evt);
        },
        onFocus(evt) {
        console.log(evt);
        },
        onContentDom(evt) {
        console.log(evt);
        },
        onDialogDefinition(evt) {
        console.log(evt);
        },
        onFileUploadRequest(evt) {
        console.log(evt);
        },
        onFileUploadResponse(evt) {
        console.log(evt);
        }
    }
}
</script>
<style lang="">
    
</style>