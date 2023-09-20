<script setup>

const props = defineProps({
    data:Object
})


</script>

<template>
    <div v-if="data.type === 'perDay' || data.type === 'perMonth' || data.type ==='perYear'" class="lg:w-2/3 w-full mx-auto my-8 overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
            <tr>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">年月日</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in data.data" :key="item.date">
                <td class="px-4 border-b-2 py-3">{{item.date}}</td>
                <td class="px-4 border-b-2 py-3">{{item.total}}</td>
            </tr>

            </tbody>
        </table>
    </div>
    <div v-if="data.type === 'decile'" class="lg:w-2/3 w-full mx-auto my-8 overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
            <tr>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">グループ</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">平均金額</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">構成比</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in data.data" :key="item.date">
                <td class="px-4 border-b-2 py-3">{{item.decile}}</td>
                <td class="px-4 border-b-2 py-3">{{item.average}}</td>
                <td class="px-4 border-b-2 py-3">{{item.totalPerGroup}}</td>
                <td class="px-4 border-b-2 py-3">{{item.totalRatio}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div v-if="data.type === 'rfm'" class="lg:w-2/3 w-full mx-auto my-8 overflow-auto">
        <div class="my-8">
            <h2 class="text-center ">RFM分析結果</h2>
            <table  class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">RANK</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">R</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">M</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="rfm in data.eachCount" :key="rfm.rank">
                    <td class="px-4 border-b-2 py-3">{{rfm.rank}}</td>
                    <td class="px-4 border-b-2 py-3">{{rfm.r}}</td>
                    <td class="px-4 border-b-2 py-3">{{rfm.f}}</td>
                    <td class="px-4 border-b-2 py-3">{{rfm.m}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <h2 class="text-center">RF分布</h2>
        <table  class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
            <tr>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">rRank</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F5</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F4</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F3</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F2</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F1</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="rf in data.data" :key="rf.rank">
                <td class="px-4 border-b-2 py-3">{{rf.rRank}}</td>
                <td class="px-4 border-b-2 py-3">{{rf.f_5}}</td>
                <td class="px-4 border-b-2 py-3">{{rf.f_4}}</td>
                <td class="px-4 border-b-2 py-3">{{rf.f_3}}</td>
                <td class="px-4 border-b-2 py-3">{{rf.f_2}}</td>
                <td class="px-4 border-b-2 py-3">{{rf.f_1}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
