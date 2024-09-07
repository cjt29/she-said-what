<template>
  <GuestLayout>
    <Head title="Sign In" />

    <template #heading>
      <h1
        class="text-center text-2xl font-bold leading-9 tracking-tight text-slate-900 dark:text-slate-100"
        v-text="'Sign in to your account'"
      />
    </template>

    <AppFormSuccessMessage
      v-if="status"
      class="mb-4"
      heading-text="Success!"
      :message="status"
    />

    <div class="rounded-lg bg-white px-6 py-12 shadow sm:px-12 dark:bg-slate-800">
      <LoginForm />
    </div>

    <p class="mt-10 text-center text-sm text-slate-700 dark:text-slate-300">
      <span v-text="`Don't have an account? `" />
      <Link
        :href="route('register')"
        class="link link--primary"
        v-text="'Sign up'"
      />
    </p>
  </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue'
import LoginForm from '@/Pages/Auth/Login/Partials/LoginForm.vue'

withDefaults(
  defineProps<{
    status?: string | null
  }>(),
  {
    status: null,
  },
)
</script>
