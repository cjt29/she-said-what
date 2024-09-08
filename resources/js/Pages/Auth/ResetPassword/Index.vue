<template>
  <GuestLayout>
    <Head title="Reset Password" />

    <template #heading>
      <AuthPageHeading text="Reset your password" />
    </template>

    <ResetPasswordForm
      :email="email"
      :token="token"
    />
  </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AuthPageHeading from '@/Pages/Auth/Partials/AuthPageHeading.vue'
import ResetPasswordForm from '@/Pages/Auth/ResetPassword/Partials/ResetPasswordForm.vue'

defineProps<{
  email: string
  token: string
}>()
</script>
