<template>
    <div class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs">        
            <ToastListItem 
            v-for="(item, index) in items"
            :key="index"
            :message="item.message"
            @remove="remove(index)"
            />
    </div>
</template>

<script setup>
import ToastListItem from '@/Components/ToastListItem.vue';
import { ref }  from "vue";

const items = ref([
    {message: "Cadastrado realizado com sucesso"},
    {message: "Erro ao casdatrar"},
    {message: "Registro deletao com sucesso"},

]);

function remove(index) {
    items.value.splice(index, 1);
}
</script>