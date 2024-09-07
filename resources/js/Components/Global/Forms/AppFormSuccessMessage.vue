<template>
  <AppInlineNotification
    :heading-text="headingText"
    type="success"
  >
    <p
      class="text-sm font-medium"
      v-html="message"
    />
  </AppInlineNotification>
</template>

<script lang="ts" setup>
defineProps<{
  message: string
  headingText: string
}>()
</script>
