<template>
  <GuestLayout>
    <Head title="Create Your Account" />

    <template #heading>
      <AuthPageHeading text="Create your account" />
    </template>

    <RegisterForm />

    <p class="mt-10 text-center text-sm text-slate-700 dark:text-slate-300">
      <span v-text="'Already have an account? '" />
      <Link
        :href="route('login')"
        class="link link--primary"
        v-text="'Sign in'"
      />
    </p>
  </GuestLayout>
</template>

<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AuthPageHeading from '@/Pages/Auth/Partials/AuthPageHeading.vue'
import RegisterForm from '@/Pages/Auth/Register/Partials/RegisterForm.vue'
</script>
