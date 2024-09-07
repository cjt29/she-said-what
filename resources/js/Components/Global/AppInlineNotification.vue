<template>
  <div
    :id="id"
    :aria-labelledby="titleId"
    :class="containerClasses"
    class="flex items-start gap-3 rounded-lg border p-4 focus:outline-none"
    role="group"
    tabindex="-1"
  >
    <component
      :is="icon"
      class="size-6 shrink-0"
    />
    <div class="flex flex-col gap-2">
      <component
        :is="titleElement"
        :id="titleId"
        class="text-sm font-semibold"
        v-text="headingText"
      />
      <slot />
    </div>
  </div>
</template>

<script lang="ts" setup>
import { CheckCircleIcon, ExclamationCircleIcon, LightBulbIcon } from '@heroicons/vue/24/outline'

const props = withDefaults(
  defineProps<{
    id?: string
    titleId?: string
    headingText: string
    focusOnMounted?: boolean
    type: 'success' | 'error' | 'warning' | 'info'
    titleElement?: 'h2' | 'h3' | 'h4' | 'h5' | 'h6'
  }>(),
  {
    titleElement: 'h2',
    focusOnMounted: true,
    id: 'inline-notification',
    titleId: 'inline-notification-title',
  },
)

const containerClasses = computed(() => ({
  'info': 'bg-blue-50 text-blue-700',
  'success': 'bg-green-50 text-green-800',
  'error': 'bg-red-50 text-red-700',
  'warning': 'bg-yellow-50 text-yellow-700',
}[props.type]))

const icon = computed(() => ({
  'info': LightBulbIcon,
  'success': CheckCircleIcon,
  'error': ExclamationCircleIcon,
  'warning': ExclamationCircleIcon,
}[props.type]))

onMounted(async () => {
  if (props.focusOnMounted) {
    await nextTick()

    document.getElementById(props.id)?.focus()
  }
})
</script>
