<template>
    <v-app>
        <v-data-table :headers="headers" :items="users" :items-per-page="5" class="elevation-1">
            <template v-slot:item.rol_user="{item}">
                <td>{{item.rol_user == 1 ? 'Director' : item.rol_user == 2 ? 'Actor' : 'Admin'}}</td>
            </template>
            <template v-slot:item.status_user="{item}">
                <td>{{item.status_user == 1 ? 'Active' : item.status_user == 0 ? 'Desactive' : 'null'}}</td>
            </template>
            <template v-slot:item.action="{item}">
                <v-switch v-model="item.status_user" :label="`Active | desactive user`" @change="ChangeStatusUser(item)"></v-switch>
            </template>
        </v-data-table>
    </v-app>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            switch1: false,
            headers: [{
                    text: 'name',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Email', value: 'email' },
                { text: 'Rol user', value: 'rol_user' },
                { text: 'Status user', value: 'status_user' },
                { text: 'Actions', value: 'action' },
            ],
        }
    },
    mounted() {
        this.$root.services.userService.getAll()
    },
    computed: {
        ...mapGetters(['users'])
    },
    methods: {
        async ChangeStatusUser(item) {
            await this.$root.services.userService.changeStatusUser(item)
            await this.$root.services.userService.getAll()
        }
    }


};

</script>
