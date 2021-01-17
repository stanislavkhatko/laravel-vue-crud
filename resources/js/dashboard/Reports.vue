<template>
    <el-main>

        <el-header>
            <el-input></el-input>
        </el-header>

        <el-table v-if="users.length"
                  :data="users"
                  style="width: 100%">
            <el-table-column label="ID" width="60">
                <template slot-scope="scope">
                    #<span>{{ scope.row.id }}</span>
                </template>
            </el-table-column>
            <el-table-column label="Gender" width="100">
                <template slot-scope="scope">
                    {{ scope.row.gender }}
                </template>
            </el-table-column>
            <el-table-column label="Birthday" width="100">
                <template slot-scope="scope">
                    {{ scope.row.dob }}
                </template>
            </el-table-column>
            <el-table-column label="Role" width="100">
                <template slot-scope="scope">
                    {{ roles.find(role => role.id === scope.row.role_id).name }}
                </template>
            </el-table-column>
            <el-table-column label="TimesRead" width="100">
                <template slot-scope="scope">
                    TODO
                </template>
            </el-table-column>
            <el-table-column label="LinesRead" width="100">
                <template slot-scope="scope">
                    TODO
                </template>
            </el-table-column>
            <el-table-column label="Transaction reward" width="100">
                <template slot-scope="scope">
                    TODO
                </template>
            </el-table-column>

        </el-table>


    </el-main>
</template>

<script>
export default {
    name: "Reports",
    data() {
        return {
            users: [],
        }
    }
}
</script>

<style scoped>

</style>
