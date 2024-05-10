import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import TheProductList from './components/products/TheProductList.vue'
import TheCategoryList from './components/Category/TheCategoryList.vue'
import BackendError from './components/Components/BackendError.vue'
import TheShoppingCart from './components/shopping/TheShoppingCart.vue'
import CategoryModal from './components/Category/CategoryModal.vue'

const app = createApp({
	components: {
		TheProductList,
		TheCategoryList,
		CategoryModal,
        TheShoppingCart
	}
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')
