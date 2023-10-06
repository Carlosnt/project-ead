<template>
  <button :type="type" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50 sm:block">
      <slot />
  </button>
</template>

<script setup>
defineProps({
  type: {
      type: String,
      default: 'submit',
  },
});
</script>
