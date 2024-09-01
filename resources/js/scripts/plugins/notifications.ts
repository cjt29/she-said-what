import { POSITION, TYPE as NotificationType, useToast } from 'vue-toastification'

import 'vue-toastification/dist/index.css'

const toast = useToast()

export const notifications = (): void => {
  router.on('finish', () => {
    const { flash } = usePage<{ flash: { body: string, type: NotificationType } }>().props

    if (flash) {
      toast(flash.body, {
        type: flash.type as unknown as  NotificationType,
        position: POSITION.BOTTOM_RIGHT,
        timeout: 5000,
      })
    }
  })
}
