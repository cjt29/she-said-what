<template>
  <GuestLayout>
    <Head title="Reset Password" />

    <template #heading>
      <h1
        class="text-center text-2xl font-bold leading-9 tracking-tight text-slate-900 dark:text-slate-100"
        v-text="'Reset your password'"
      />
    </template>

    <div class="rounded-lg bg-white px-6 py-12 shadow sm:px-12 dark:bg-slate-800">
      <ResetPasswordForm
        :email="email"
        :token="token"
      />
    </div>
  </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue'
import ResetPasswordForm from '@/Pages/Auth/ResetPassword/Partials/ResetPasswordForm.vue'

defineProps<{
  email: string
  token: string
}>()
</script>
