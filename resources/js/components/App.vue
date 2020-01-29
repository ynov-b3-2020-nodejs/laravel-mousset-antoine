
<template>
    <div id="app">
        <div class="heading">
            <h1>Crud</h1>
        </div>
        <crud-component
            v-for="crud in crud"
            v-bind="crud"
            :key="crud.id"
            @update="update"
            @delete="del"
        />
        <div>
            <button @click="create">Add</button>
        </div>
    </div>
</template>

<script>
    function Crud({ id, color, name}) {
        this.id = id;
        this.color = color;
        this.name = name;
    }

    import CrudComponent from './components/CrudComponent.vue';

    export default {
        data() {
            return {
                crud: [],
                mute: false
            }
        },
        methods: {
            async create() {
                const { data } = window.axios.get('/api/crud/create');
                this.crud.push(new Crud(data));
            },
            async del(id) {
                await window.axios.delete(`/api/crud/${id}`);
                let index = this.crud.findIndex(crud => crud.id === id);
                this.crud.splice(index, 1);
            },
            async read() {
                const { data } = window.axios.get('/api/crud');
                data.forEach(crud => this.crud.push(new Crud(crud)));
            },
            async update(id, color) {
                this.mute = true;
                await window.axios.put(`/api/crud/${id}`, { color });
                this.crud.find(crud => crud.id === id).color = color;
                this.mute = false;
            },

            created() {
                this.read();
            }
        },

        components: {
            CrudComponent
        }

    }

</script>
<style>
    #app {
        margin-left: 1em;
    }
    .heading h1 {
        margin-bottom: 0;
    }
</style>
