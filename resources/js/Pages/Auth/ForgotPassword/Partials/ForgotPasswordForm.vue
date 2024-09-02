<template>
  <!-- TODO: Make a reusable, accessible form error display. -->
  <form
    novalidate
    class="space-y-6"
    @submit.prevent="handleSubmit"
  >
    <AppTextInput
      id="email"
      v-model="form.email"
      type="email"
      required
      autocomplete="email"
      label="Email"
      :error-message="form.errors.email"
      @input="form.clearErrors('email')"
    />

    <div>
      <AppButton
        class="btn--primary btn--lg w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        text="Email Password Reset Link"
        type="submit"
      >
        <template #buttonIcon>
          <InboxArrowDownIcon class="size-5" />
        </template>
      </AppButton>
    </div>
  </form>
</template>

<script setup lang="ts">
import { InboxArrowDownIcon } from '@heroicons/vue/24/outline'

const form = useForm({
  email: '',
})

const handleSubmit = (): void => {
  form.post(route('password.email'))
}
</script>
