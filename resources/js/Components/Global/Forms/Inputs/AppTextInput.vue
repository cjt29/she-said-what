<template>
  <div :class="{ 'w-full': fullWidth }">
    <label
      :class="labelClasses"
      :for="id"
    >
      <span
        :class="{ 'sr-only': hideLabel }"
        v-text="label"
      />
      <span
        v-if="required"
        :class="{ 'sr-only': hideLabel }"
        aria-hidden="true"
        class="text-red-700 dark:text-red-400"
        v-text="'*'"
      />
      <slot name="inputLink" />
    </label>
    <input
      :id="id"
      v-model="model"
      :aria-invalid="!!errorMessage"
      :autocomplete="autocomplete"
      :class="inputClasses"
      :disabled="disabled"
      :name="id"
      :placeholder="placeholder"
      :required="required"
      :type="type"
      class="block w-full rounded-md border-0 bg-slate-50 py-2 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-900 disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-500 sm:leading-6 dark:bg-white/5 dark:text-slate-200 dark:ring-white/10 dark:focus:ring-indigo-300 disabled:dark:bg-white/10 disabled:dark:text-slate-600"
    >
    <div
      v-if="errorMessage"
      class="mt-1.5 flex items-center gap-2 text-sm text-red-700 dark:text-red-400"
    >
      <ExclamationCircleIcon class="size-4 shrink-0" />
      <span v-text="errorMessage" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline'

import { HtmlAutocomplete } from '@/scripts/custom-types/HtmlAutocomplete'

withDefaults(
  defineProps<{
    id: string
    label: string
    disabled?: boolean
    required?: boolean
    fullWidth?: boolean
    hideLabel?: boolean
    placeholder?: string
    labelClasses?: string | null
    autocomplete?: HtmlAutocomplete
    errorMessage?: string | undefined
    inputClasses?: string | string[] | null
    type?: 'text' | 'password' | 'email' | 'number' | 'date'
  }>(),
  {
    type: 'text',
    disabled: false,
    fullWidth: true,
    placeholder: '',
    required: false,
    hideLabel: false,
    inputClasses: null,
    labelClasses: null,
    autocomplete: 'off',
    errorMessage: undefined,
  },
)

const model = defineModel<string>({
  default: '',
  required: true,
})
</script>
