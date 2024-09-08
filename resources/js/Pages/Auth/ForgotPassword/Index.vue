<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <template #heading>
      <AuthPageHeading text="Get a password reset link" />
    </template>

    <p
      class="mb-4 text-sm text-slate-700 dark:text-slate-300"
      v-text="'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.'"
    />

    <AppFormSuccessMessage
      v-if="status"
      class="mb-4"
      heading-text="Success!"
      :message="status"
    />

    <ForgotPasswordForm />
  </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AuthPageHeading from '@/Pages/Auth/Partials/AuthPageHeading.vue'
import ForgotPasswordForm from '@/Pages/Auth/ForgotPassword/Partials/ForgotPasswordForm.vue'

withDefaults(
  defineProps<{
    status?: string | null
  }>(),
  {
    status: null,
  },
)
</script>
