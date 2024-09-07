<template>
  <AppInlineNotification
    v-if="!isEmpty(errors)"
    :id="id"
    :focus-on-mounted="!isEmpty(errors)"
    :heading-text="headingText"
    :title-element="titleElement"
    :title-id="titleId"
    type="error"
  >
    <ol class="flex list-decimal flex-col gap-2 pl-5">
      <li
        v-for="(error, key) in errors"
        :key="key"
        class="text-sm text-red-700"
      >
        <!-- It's important that the form input ID matches the error key. -->
        <a
          :href="`#${key}`"
          class="custom-focus rounded-sm underline"
          v-text="error"
        />
      </li>
    </ol>
  </AppInlineNotification>
</template>

<script lang="ts" setup>
import isEmpty from 'lodash.isempty'

const props = withDefaults(
  defineProps<{
    id?: string
    titleId?: string
    titleElement?: 'h2' | 'h3' | 'h4' | 'h5' | 'h6'
    errors: {
      [key: string]: string
    }
  }>(),
  {
    titleElement: 'h2',
    id: 'error-summary',
    titleId: 'error-summary-title',
  },
)

const headingText = computed(() => {
  const errorCount = Object.keys(props.errors).length

  return `There ${errorCount === 1 ? 'was' : 'were'} ${errorCount} ${errorCount === 1 ? 'error' : 'errors'} found in the information you submitted.`
})
</script>
