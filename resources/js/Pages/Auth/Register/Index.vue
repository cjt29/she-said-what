<template>
  <GuestLayout>
    <Head title="Create Your Account" />

    <template #heading>
      <h1
        class="text-center text-2xl font-bold leading-9 tracking-tight text-slate-900 dark:text-slate-100"
        v-text="'Create your account'"
      />
    </template>

    <div class="rounded-lg bg-white px-6 py-12 shadow sm:px-12 dark:bg-slate-800">
      <RegisterForm />
    </div>

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
import RegisterForm from '@/Pages/Auth/Register/Partials/RegisterForm.vue'
</script>
