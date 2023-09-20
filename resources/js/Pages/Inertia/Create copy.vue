<script setup>
    import {reactive} from 'vue'
    import {Inertia} from '@inertiajs/inertia'
    import InputError from '@/Components/InputError.vue';

    defineProps({
        errors:Object
    })

    const form = reactive({
        title:null,
        content:null
    })

    const submitFunction = () =>{
        Inertia.post('/inertia',form)
    }
    </script>

    <template>
        <div v-if="errors.title">{{errors.title}}</div>
        <div v-if="errors.content">{{errors.content}}</div>
        <form @submit.prevent="submitFunction">
            <input type="text" name="title" v-model="form.title"><br>
            <InputError class="mt-2" :message="form.errors.email" /><br>
            <input type="text" name="content" v-model="form.content"><br>
            <InputError class="mt-2" :message="form.errors.email" />
            <button>送信</button>
        </form>
    </template>