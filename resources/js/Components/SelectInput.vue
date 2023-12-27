<template>
    <select class="block mt-1 w-full rounded-md form-input focus:border-indigo-600"
    :value="modelValue"
    @change="$event => $emit('update:modelValue', $event.target.value)" ref="input">
    <option v-for="(op,index) in options" :key="op.i" :value="op.id" :selected="index == 0">
        {{ op.name }}
    </option>
    </select>
</template>

<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue','options']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>
