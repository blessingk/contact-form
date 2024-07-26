import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './routes'

const sonar = await fetch(
        "https://fixr-code.onrender.com/fix-code",
        {
          headers: {
            "Content-Type": "application/json",
          },
          method: "POST",
          body: JSON.stringify({
            code: inputCode,
            file_path: filePath,
          }),
        }
      )

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')
