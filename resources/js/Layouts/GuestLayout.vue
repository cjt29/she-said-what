<template>
  <div class="flex min-h-screen flex-col items-center bg-slate-100 py-12 sm:justify-center sm:px-6 lg:px-8 dark:bg-slate-900">
    <div class="flex flex-col items-center gap-6 sm:mx-auto sm:w-full sm:max-w-md">
      <Link
        :href="route('home')"
        class="custom-focus rounded-md text-indigo-700 dark:text-indigo-400"
      >
        <span
          class="sr-only"
          v-text="'Home'"
        />
        <AppLogo class="size-20 fill-current" />
      </Link>

      <slot name="heading" />
    </div>

    <div class="mt-10 w-4/5 sm:mx-auto sm:w-full sm:max-w-[480px]">
      <slot />
    </div>
  </div>
</template>
