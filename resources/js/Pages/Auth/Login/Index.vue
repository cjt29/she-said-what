<template>
  <GuestLayout>
    <Head title="Sign In" />

    <template #heading>
      <AuthPageHeading text="Sign in to your account" />
    </template>

    <AppFormSuccessMessage
      v-if="status"
      class="mb-4"
      heading-text="Success!"
      :message="status"
    />

    <LoginForm />

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
import AuthPageHeading from '@/Pages/Auth/Partials/AuthPageHeading.vue'

withDefaults(
  defineProps<{
    status?: string | null
  }>(),
  {
    status: null,
  },
)
</script>
