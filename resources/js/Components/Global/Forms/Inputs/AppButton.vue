<template>
  <button
    :disabled="disabled"
    :type="type"
    class="btn"
  >
    <slot
      v-if="iconPosition === 'left'"
      name="buttonIcon"
    />
    <span
      class="whitespace-nowrap"
      v-text="text"
    />
    <span
      v-if="screenReaderText"
      class="sr-only"
      v-text="screenReaderText"
    />
    <slot
      v-if="iconPosition === 'right'"
      name="buttonIcon"
    />
  </button>
</template>

<script lang="ts" setup>
withDefaults(
  defineProps<{
    text: string
    disabled?: boolean
    screenReaderText?: string
    type?: 'button' | 'submit'
    iconPosition?: 'left' | 'right',
  }>(),
  {
    type: 'button',
    disabled: false,
    iconPosition: 'left',
    screenReaderText: '',
  },
)
</script>
