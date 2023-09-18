<script setup>

const props = defineProps({
    data:Object
})


</script>

<template>
    <div v-if="data.data === 'decile'" class="lg:w-2/3 w-full mx-auto my-8 overflow-auto">
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
</template>
