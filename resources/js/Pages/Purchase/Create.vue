<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {getToday} from '@/common'
import {Inertia} from '@inertiajs/inertia';
import {onMounted ,reactive,ref,computed} from 'vue'
import MicroModal from '@/Components/MicroModal.vue'

onMounted(() => {
    form.date = getToday()
})

const form = reactive({
    date: null,
    customer_id:null,//このcustomer_idはemitの受け取り先として必要
    status:true,
    items:[]
})

const props = defineProps({
    // セレクトボックスを使う場合はいる(今回はModalからemit)
    //customers : Array,
    items :Array
})

const itemList = ref([])

onMounted(()=>{
    props.items.forEach(item => {
        itemList.value.push({
            id:item.id,
            name:item.name,
            price:item.price,
            quantity:0
        })
    })
})

const totalPrice = computed(()=>{
    let total = 0
    itemList.value.forEach(item => {
        total += item.price*item.quantity
    })
    return total
})

const quantity=[0,1,2,3,4,5,6,7,8,9];

const storePurchase = () =>{
    itemList.value.forEach(item=>{
        if(item.quantity > 0){
            form.items.push({
                id:item.id,
                quantity:item.quantity
            })
        }
    })
    Inertia.post(route('purchases.store'),form)
}

const setCustomerId = (id) =>{
    form.customer_id = id
}

</script>

<template>
    <Head title="購入画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入画面</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storePurchase">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="date" class="leading-7 text-sm text-gray-600 ">日付</label>
                                                <input type="date" id="date" name="date" v-model="form.date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <!-- モーダルで顧客検索結果がemitできるようになったためカット(参考のために残す) -->
                                                <!-- <div class="relative">
                                                    <label for="customer" class="leading-7 text-sm text-gray-600 ">会員</label>
                                                    <select id="customer" name="customer" v-model="form.customer_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <option v-for="customer in props.customers" :value="customer.id" :key="customer.id">
                                                            {{customer.id}}:{{customer.name}}
                                                        </option>
                                                    </select>    
                                                </div> -->
                                                <div>
                                                    <MicroModal @update:customerId="setCustomerId"/>
                                                </div>
                                            </div>
                                            <div class=" w-full mt-8 mx-auto overflow-auto">
                                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                                    <thead>
                                                    <tr>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">価格</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">個数</th>
                                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">小計</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr  v-for="item in itemList" :key="item.id">
                                                        <td class="px-4 border-b-2 py-3 ">{{item.id}}</td>
                                                        <td class="px-4 border-b-2 py-3">{{item.name}}</td>
                                                        <td class="px-4 border-b-2 py-3">{{item.price}}</td>
                                                        <td class="px-4 border-b-2 py-3">
                                                            <select name="quantity" id="quantity" v-model="item.quantity">
                                                                <option v-for="q in quantity" :key="q.index" :value="q">{{q}}</option>
                                                            </select>
                                                        </td>
                                                        <td class="px-4 border-b-2 py-3">{{ item.price * item.quantity }}</td>                                          
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            <div class="p-2 w-full">
                                                <div>
                                                    <label for="price" class="leading-7 text-sm text-gray-600 ">合計：</label>
                                                    {{totalPrice}} 円
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                            <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
