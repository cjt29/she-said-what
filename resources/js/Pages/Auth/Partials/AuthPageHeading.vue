<template>
  <h1
    class="text-center text-2xl font-bold leading-9 tracking-tight text-slate-800 dark:text-slate-200"
    v-text="text"
  />
</template>

<script setup lang="ts">
defineProps<{
  text: string
}>()
</script>
