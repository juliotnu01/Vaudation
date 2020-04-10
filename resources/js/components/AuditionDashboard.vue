<template>
    <v-app> 
        <v-layout row wrap>
            <v-flex xs12 sm12 md4 class="mb-1" v-for="(audition, key) in data_auditions" :key="audition.id">
                <v-card max-width="344" class="mx-auto">
                    <v-list-item>
                        <v-list-item-avatar color="grey">
                            <v-img :src="audition.banner_audition" height="194"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title class="headline">{{audition.title_audition}}</v-list-item-title>
                            <v-list-item-subtitle>by {{audition.related_user.name}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-img :src="audition.banner_audition" height="194"></v-img>
                    <v-card-text>
                        <strong>Description</strong>: {{audition.description_audition}}<br/>
                        <v-divider></v-divider>
                        <strong>Script:</strong> {{audition.script_text_audition}}<br/>
                        <v-divider></v-divider>
                        <strong>Date of audition:</strong> {{audition.created_at.substr(0,10)}} to {{audition.end_date_available}}
                    </v-card-text>
                    <v-card-actions>
                        <router-link :to="{ name: 'audition.person', params: { id_audition: audition.id }}">
                                READ
                        </router-link>
                        <v-spacer></v-spacer>
                        <v-btn icon>
                            <v-icon>mdi-heart</v-icon>
                        </v-btn>
                        <v-btn icon>
                            <v-icon>mdi-share-variant</v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout> 
    </v-app>
</template>
<script>
export default {
    data() {
        return {

            data_auditions: [],
        }
    },
    mounted() {
        this.getAudition();
    },
    methods: {
        async getAudition() {
            const URL = `get-audition`
            try {
                let { data } = await axios(URL)
                this.data_auditions = data
            } catch (e) {
                // statements
                console.log(e);
            }
        }
    }
}

</script>
