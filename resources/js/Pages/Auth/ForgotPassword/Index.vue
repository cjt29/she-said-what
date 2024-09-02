<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <template #heading>
      <h1
        class="text-center text-2xl font-bold leading-9 tracking-tight text-slate-900 dark:text-slate-100"
        v-text="'Get a password reset link'"
      />
    </template>

    <p class="mb-4 text-sm text-slate-600 dark:text-slate-400">
      Forgot your password? No problem. Just let us know your email address and we will email you a password reset
      link that will allow you to choose a new one.
    </p>

    <!-- TODO: Make this a reusable, accessible notice. -->
    <p
      v-if="status"
      class="mb-4 text-sm font-medium text-green-700 dark:text-green-400"
      v-text="status"
    />

    <div class="rounded-lg bg-white px-6 py-12 shadow sm:px-12 dark:bg-slate-800">
      <ForgotPasswordForm />
    </div>
  </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue'
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
