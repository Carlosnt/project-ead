<script setup>
import Editor from '@tinymce/tinymce-vue'

</script>

<template>
    <Editor
      api-key="5y0wd3lzkrvuo2vj1r0dbpen9fpw4ot7vl16fzjaamvg1yea"
      :init="{  
        entity_encoding: 'raw',      
        selector: 'textarea',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | help',
        language: 'pt_BR',        
      }" 
    />
</template>
