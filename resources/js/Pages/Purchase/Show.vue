<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import {Inertia,} from '@inertiajs/inertia';
import dayjs from 'dayjs'



const props = defineProps({
    // セレクトボックスを使う場合はいる(今回はModalからemit)
    //customers : Array,
    items :Array,
    order :Array,
})



</script>

<template>
    <Head title="購買履歴詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴詳細</h2>
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
                                                    <div type="date" id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ dayjs(props.order[0].create_at).format('YYYY-MM-DD hh:mm:ss') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div>
                                                    <div type="date" id="date" name="date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        {{ props.order[0].customer_name}}
                                                    </div>
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
                                                    <tr  v-for="item in props.items" :key="item.id">
                                                        <td class="px-4 border-b-2 py-3 ">{{item.item_id}}</td>
                                                        <td class="px-4 border-b-2 py-3">{{item.item_name}}</td>
                                                        <td class="px-4 border-b-2 py-3">{{item.item_price}}</td>
                                                        <td class="px-4 border-b-2 py-3">{{item.quantity}}</td>
                                                        <td class="px-4 border-b-2 py-3">{{ item.item_price * item.quantity }}</td>                                          
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div>
                                                    <label for="price" class="leading-7 text-sm text-gray-600 ">合計：</label>
                                                    <div>
                                                        {{props.order[0].total}} 円
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div>
                                                    <label for="price" class="leading-7 text-sm text-gray-600 ">ステータス</label>
                                                    <div v-if="props.order[0].status == true">
                                                        未キャンセル
                                                    </div>
                                                    <div v-if="props.order[0].status == false">
                                                        キャンセル済
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full">
                                                <div>
                                                    <label for="price" class="leading-7 text-sm text-gray-600 ">キャンセル日</label>
                                                    <div v-if="props.order[0].status ==  false">
                                                        {{dayjs(props.order[0].updated_at).format('YYYY-MM-DD hh:mm:ss')}} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 w-full" v-if="props.order[0].status == true">
                                            <Link as="button" :href="route('purchases.edit',{purchase:props.order[0].id})" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</Link>
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
