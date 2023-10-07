<script setup>
import Editor from '@tinymce/tinymce-vue'
</script>

<template>
  <main id="sample">
   
    <Editor
      api-key="5y0wd3lzkrvuo2vj1r0dbpen9fpw4ot7vl16fzjaamvg1yea"
      :init="{
        selector: 'textarea',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | help',
        language: 'pt_BR',
      }"
    />
  </main>
</template>

<style scoped>
.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  #sample {
    display: flex;
    flex-direction: column;
    place-items: center;
    width: 1000px;
  }
}
</style>