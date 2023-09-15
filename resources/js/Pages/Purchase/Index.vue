<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue'
import dayjs from 'dayjs'

const props = defineProps({
    orders : Object
})

const search = ref('')

const searchorders = () =>{
    Inertia.get(route('orders.index',{search:search.value}))
}

</script>


<template>
    <Head title="購買履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="text-gray-600 body-font">

                    <div class="container px-5 py-8 mx-auto">
                        <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                        </div>
                        <div>
                            <input type="text" name="search" v-model="search">
                            <button class="bg-blue-300 text-white py-2 px-2"
                                @click="searchorders">検索</button>
                        </div>
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">購入日</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in props.orders.data" :key="order.id">
                                <td class="px-4 border-b-2 py-3 ">
                                    <Link class="text-blue-400" :href="route('purchases.show',{purchase:order.id})">{{order.id}}</Link>
                                </td>
                                <td class="px-4 border-b-2 py-3">{{order.customer_name}}</td>
                                <td class="px-4 border-b-2 py-3">{{order.total}}</td>
                                <td class="px-4 border-b-2 py-3">{{order.status }}</td>                             
                                <td class="px-4 border-b-2 py-3">{{dayjs(order.created_at).format('YYYY-MM-DD hh:mm:ss' ) }}                                 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination class="mt-6" :links="props.orders.links"></Pagination>

                    </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
