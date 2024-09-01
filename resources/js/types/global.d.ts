import { PageProps as AppPageProps } from './'
import { PageProps as InertiaPageProps } from '@inertiajs/core'

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}

declare module '@inertiajs/vue3' {
  // The T generic will combine any type added to it & the PageProps interface defined in @inertiajs/core
  export function usePage<T>(): Page<T>
}
