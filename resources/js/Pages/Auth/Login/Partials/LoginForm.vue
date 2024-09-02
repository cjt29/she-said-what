<template>
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

    <AppTextInput
      id="password"
      v-model="form.password"
      type="password"
      required
      label="Password"
      autocomplete="current-password"
      :error-message="form.errors.password"
      @input="form.clearErrors('password')"
    />

    <div class="flex items-center justify-between">
      <AppCheckboxInput
        id="remember"
        v-model="form.remember"
        label="Remember me"
      />

      <Link
        :href="route('password.request')"
        class="link link--primary text-sm"
        v-text="'Forgot your password?'"
      />
    </div>

    <div>
      <AppButton
        class="btn--primary btn--lg w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        text="Sign In"
        type="submit"
      >
        <template #buttonIcon>
          <ArrowRightEndOnRectangleIcon class="size-5" />
        </template>
      </AppButton>
    </div>
  </form>
</template>

<script setup lang="ts">
import { ArrowRightEndOnRectangleIcon } from '@heroicons/vue/24/outline'

import AppCheckboxInput from '@/Components/Global/Forms/Inputs/AppCheckboxInput.vue'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const handleSubmit = (): void => {
  form.post(route('login'), {
    onFinish: () => {
      form.reset('password')
    },
  })
}
</script>
