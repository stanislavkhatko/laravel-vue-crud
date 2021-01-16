<template>

    <el-container>
        <el-aside width="200px" style="background-color: rgb(238, 241, 246)">
            <el-menu :default-openeds="['1', '3']">
                <el-menu-item index="1">
                    <router-link to="/users"><i class="el-icon-user"></i>Users</router-link>
                </el-menu-item>
                <el-menu-item index="1">
                    <router-link to="/reports"><i class="el-icon-document"></i>Reports</router-link>
                </el-menu-item>

            </el-menu>
        </el-aside>

        <el-container style="min-height: 100vh">
            <el-header style="text-align: right; font-size: 12px; padding:10px">
                Hello, {{ $store.getters.userName }}
                <el-button size="medium" type="danger" @click="logout">Logout</el-button>
            </el-header>

            <router-view></router-view>

        </el-container>
    </el-container>

</template>

<script>
export default {
    name: "Dashboard",
    methods: {
        logout() {
            axios.post('/logout').then(response => {
                this.$store.commit('unsetUser');
                this.$message.success("Logout successfull");
                this.$router.push('/login')
            })
        }
    }
}
</script>

<style scoped>

</style>

