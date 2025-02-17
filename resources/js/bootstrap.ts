import axios from 'axios'

declare global {
  interface Window {
    axios: typeof import('axios').default
  }
}

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.withCredentials = true
