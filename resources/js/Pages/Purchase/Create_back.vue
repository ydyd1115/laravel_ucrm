<script setup>
import {getToday} from '@/common'
import {Inertia} from '@inertiajs/inertia';
import {onMounted ,reactive,ref,computed} from 'vue'

onMounted(() => {
    form.date = getToday()
})

const form = reactive({
    date: null,
    customer_id:null,
    status:true,
    items:[]
})

const props = defineProps({
    customers : Array,
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
</script>

<template>
    <form @submit.prevent="storePurchase">

        日付
        <input type="date" name="date" v-model="form.date"><br>
        会員名<br>
        <select name="customer" v-model="form.customer_id">
            <option v-for="customer in props.customers" :value="customer.id" :key="customer.id">
                {{customer.id}}:{{customer.name}}
            </option>
        </select><br><br>
        商品・サービス
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>数量</th>
                <th>個数</th>
                <th>小計</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in itemList" :key="item.id">
                <td>{{item.id}}</td>
                <td>{{item.name}}</td>
                <td>{{item.price}}</td>
                <td>
                    <select name="quantity" id="quantity" v-model="item.quantity">
                        <option v-for="q in quantity" :key="q.index" :value="q">{{q}}</option>
                    </select>

                </td>
                <td>{{ item.price * item.quantity }}</td>
            </tr>
        </tbody>
        <p>合計：{{totalPrice}}</p>
        <button>登録する</button>
    </form>


</template>