<template>
    <v-app>
        <v-container>
            <v-row>
                <v-col v-for="n  in 12" :key="n" cols="12" sm="4" md="4" xs="12" v-if="skeletonCardLoading">
                    <skeletonComponent/>
                </v-col>
                <v-col v-for="p in project" :key="p.id" cols="12" sm="4" md="4" xs="12" v-if="!skeletonCardLoading">
                    <v-card max-width="344" class="mx-auto">
                        <v-list-item>
                            <!-- <v-list-item-avatar color="grey"></v-list-item-avatar> -->
                            <v-list-item-content>
                                <v-list-item-title class="headline">{{p.project_name}}</v-list-item-title>
                                <!-- <v-list-item-subtitle>by Kurt Wagner</v-list-item-subtitle> -->
                            </v-list-item-content>
                        </v-list-item>
                        <v-img src="https://img.icons8.com/wired/64/000000/movie-projector.png" height="194" contain></v-img>
                        <!-- <v-card-text>
                            Visit ten places on our planet that are undergoing the biggest changes today.
                        </v-card-text> -->
                        <v-card-actions>
                            <v-btn color="purple" text>
                                <router-link :to="{name: 'dashboard.casting', params:{ id_project: p.id} }">
                                    Explore
                                </router-link>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>
<script>
import skeletonComponent from './skeletonComponent.vue'
import { mapState } from 'vuex'
export default {
    components:{
        skeletonComponent //skeletonCard
    },
    async created() {
        await this.$root.services.userService.get(this.$route.params.id_user)
        if (this.user.rol_user == 1) {
          await  this.$root.services.projectService.get(this.$route.params.id_user)
        }else {
           await this.$root.services.projectService.get()
        }
    },
    computed: {
        ...mapState(['project', 'skeletonCardLoading', 'user'])
    }
};

</script>
