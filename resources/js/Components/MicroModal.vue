<script setup>
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue'
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value}
const search = ref('')
const customers = reactive({})
const searchCustomers = async () => {
try{
await axios.get(`/api/searchCustomers/?search=${search.value}`)
.then( res => {
console.log(res.data)
customers.value = res.data
})
toggleStatus()
} catch (e){
console.log(e.message)
}
}

//axiosの動作確認用//
// onMounted(()=>{
//     axios.get('/api/user')
//     .then(res => {
//         console.log(res)
//     })
// })

const emit = defineEmits(['update:customerId'])
const setCustomer = (e) => {
    search.value.kana
    emit('update:customerId', e.id)
    toggleStatus()
}

</script>

<template>
<div id="modal-1" class="modal" aria-hidden="true" v-show="isShow">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
            <h2 class="modal__title" id="modal-1-title">
            顧客検索
            </h2>
            <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
            <div v-if="customers.value">

                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">指名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">電話番号</th>
                            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="customer in customers.value.data" :key="customer.id">
                            <td class="px-4 border-b-2 py-3 ">
                                <button type="button" @click="setCustomer({id:customer.id, kana:customer.kana})"  class="text-blue-400">
                                    {{customer.id }}
                                </button>
                            </td>
                            <td class="px-4 border-b-2 py-3">{{customer.name}}</td>
                            <td class="px-4 border-b-2 py-3">{{customer.kana}}</td>
                            <td class="px-4 border-b-2 py-3">{{customer.tel }}                                 
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <footer class="modal__footer">
            <button @click="toggleStatus" type="button" class="modal__btn modal__btn-primary">Continue</button>
            <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
        </footer>
        </div>
    </div>
</div>
<div class="flex flex-row">
    <input name="customer" v-model="search" class="w-1/2 my-2 mx-auto overflow-auto">
    <button @click="searchCustomers" class="flex mx-auto my-2  text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" type="button" data-micromodal-trigger="modal-1" href='javascript:;'>会員検索</button>
</div>
</template>