<template>
    <div class="text-center">
        <v-overlay :value="overlay" opacity="0.45" >
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
    </div>
</template>
<script>
    import {mapState} from 'vuex'
    export default {
        name: 'loadin',
        computed:{ 
            ...mapState(['overlay'])
        }

    };
</script>
