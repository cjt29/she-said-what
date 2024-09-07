<template>
  <form
    novalidate
    class="space-y-6"
    @submit.prevent="handleSubmit"
  >
    <AppFormErrorSummary :errors="form.errors" />

    <AppTextInput
      id="email"
      v-model="form.email"
      type="email"
      required
      disabled
      autocomplete="email"
      label="Email"
      :error-message="form.errors.email"
      @input="form.clearErrors('email')"
    />

    <AppTextInput
      id="password"
      v-model="form.password"
      type="password"
      required
      label="New Password"
      autocomplete="new-password"
      :error-message="form.errors.password"
      @input="form.clearErrors('password')"
    />

    <AppTextInput
      id="password_confirmation"
      v-model="form.password_confirmation"
      type="password"
      required
      label="Confirm New Password"
      autocomplete="new-password"
      :error-message="form.errors.password_confirmation"
      @input="form.clearErrors('password_confirmation')"
    />

    <div>
      <AppButton
        class="btn--primary btn--lg w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        text="Reset Password"
        type="submit"
      >
        <template #buttonIcon>
          <LockClosedIcon class="size-5" />
        </template>
      </AppButton>
    </div>
  </form>
</template>

<script setup lang="ts">
import { LockClosedIcon } from '@heroicons/vue/24/outline'

const props = defineProps<{
  email: string
  token: string
}>()

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

const handleSubmit = (): void => {
  form.post(route('password.store'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    },
  })
}
</script>
