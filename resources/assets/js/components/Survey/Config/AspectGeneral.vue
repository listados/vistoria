<template>
    <div>
        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
</template>

<script>
import { ClassicEditor } from 'ckeditor5';


export default {
    name: 'app',
    data() {
        return {
            editor: ClassicEditor,
            editorData: '<p>Hello from CKEditor 5 in Vue 2!</p>',
            editorConfig: {
                toolbar: {
                    items: [ 'undo', 'redo', '|', 'bold', 'italic' ],
                 },
                plugins: [
                    Bold, Essentials, Italic, Mention, Paragraph, SlashCommand, Undo
                ],
                licenseKey: '<YOUR_LICENSE_KEY>',
                mention: { 
                    // Mention configuration
                }
            }
        };
    }
};
</script>

<style>

</style>