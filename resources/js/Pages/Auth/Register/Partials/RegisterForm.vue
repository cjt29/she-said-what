<template>
  <form
    novalidate
    class="space-y-6"
    @submit.prevent="handleSubmit"
  >
    <AppTextInput
      id="username"
      v-model="form.username"
      type="text"
      label="Username"
      required
      autocomplete="username"
      :error-message="form.errors.username"
      @input="form.clearErrors('username')"
    />

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
      autocomplete="new-password"
      label="Password"
      :error-message="form.errors.password"
      @input="form.clearErrors('password')"
    />

    <AppTextInput
      id="password_confirmation"
      v-model="form.password_confirmation"
      type="password"
      required
      autocomplete="new-password"
      label="Confirm Password"
      :error-message="form.errors.password_confirmation"
      @input="form.clearErrors('password_confirmation')"
    />

    <div>
      <AppButton
        class="btn--primary btn--lg w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        text="Register"
        type="submit"
      >
        <template #buttonIcon>
          <UserPlusIcon class="size-5" />
        </template>
      </AppButton>
    </div>
  </form>
</template>

<script setup lang="ts">
import { UserPlusIcon } from '@heroicons/vue/24/outline'

const form = useForm({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const handleSubmit = (): void => {
  form.post(route('register'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    },
  })
}
</script>
