<template>
    <div>
        <form @submit.prevent>
            <span>Change role:</span>&nbsp;&nbsp;
            <label class="switch">
                <input type="checkbox" v-model="role" @change="changeRole">
                <span class="slider round"></span>
            </label>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true
            }
        },
        data () {
            return {
                role: false,
                refRole: ''
            }
        },
        methods: {
            changeRole () {
                axios.put(this.route, {
                    role: this.role
                })
                .then(response => {
                    if (response.data.role) {
                        this.refRole.innerText = response.data.role;
                    }
                })
                .catch(error => {
                    // console.log(error);
                });
            }
        },
        mounted () {
            this.refRole = this.$parent.$refs.userRole;
            if (this.refRole.innerText == 'admin') {
                this.role = true;
            }
        },
    }
</script>
