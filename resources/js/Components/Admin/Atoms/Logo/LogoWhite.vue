<template>
    <img class="imagem-responsiva" :src="url" :alt="titulo">
</template>

<script>

/*Propriedades que o Elemento pode receber */
export default {
    props: ["resources/images/logo.png", "titulo"],
}
</script>