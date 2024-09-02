<template>
  <div :class="containerClasses">
    <label
      :for="id"
      :class="labelClasses"
      class="mb-0 flex items-center gap-2"
    >
      <input
        :id="id"
        v-model="model"
        :value="$attrs.value ?? null"
        :name="id"
        :disabled="disabled"
        :class="inputClasses"
        type="checkbox"
        class="size-5 rounded-md border-slate-300 text-indigo-700 shadow-sm focus:ring-indigo-900 dark:border-slate-700 dark:bg-slate-900 dark:text-indigo-300 dark:focus:ring-indigo-200 dark:focus:ring-offset-slate-800"
      >
      <span
        class="text-sm font-medium"
        :class="{ 'sr-only': hideLabel }"
        v-text="label"
      />
    </label>
    <div
      v-if="errorMessage"
      class="mt-1.5 flex items-center gap-2 text-sm text-red-600 dark:text-red-300"
    >
      <ExclamationCircleIcon class="size-4 shrink-0" />
      <span v-text="errorMessage" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline'

type CheckboxModelValue = boolean | string | number | (string | number)[]

withDefaults(
  defineProps<{
    id: string
    label?: string
    disabled?: boolean
    required?: boolean
    hideLabel?: boolean
    placeholder?: string
    labelClasses?: string | null
    containerClasses?: string | null
    errorMessage?: string | undefined
    inputClasses?: string | string[] | null
  }>(),
  {
    label: '',
    disabled: false,
    placeholder: '',
    required: false,
    hideLabel: false,
    inputClasses: null,
    labelClasses: null,
    containerClasses: null,
    errorMessage: undefined,
  },
)

const model = defineModel<CheckboxModelValue>({
  default: '',
  required: true,
})
</script>
