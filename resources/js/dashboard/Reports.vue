<template>
    <el-main>

        <el-header>
            <el-row :gutter="10">
                <el-col :span="3">            <el-input></el-input>
                </el-col>
                <el-col :span="3"></el-col>
                <el-col :span="3"></el-col>
            </el-row>
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
                    {{ scope.row.role.name }}
                </template>
            </el-table-column>
            <el-table-column label="TimesRead" width="100">
                <template slot-scope="scope">
                    {{ getTotalTimesRead(scope.row) }}
                </template>
            </el-table-column>
            <el-table-column label="LinesRead" width="100">
                <template slot-scope="scope">
                    {{ getTotalLinesRead(scope.row) }}
                </template>
            </el-table-column>
            <el-table-column label="Transaction reward" width="100">
                <template slot-scope="scope">
                    {{ getTotalTransactionoReward(scope.row) }}
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
            transactions: [],
        }
    },
    mounted() {
        axios.get('/api/reports').then(response => {
            this.users = response.data.users;
            this.transactions = response.data.transactions;
        })
    },
    methods: {
        getTotalTimesRead (user) {
            return this.transactions.reduce((total, transaction) => {
                return (transaction.user_id === user.id && transaction.type === 'time') ? total + transaction.amount : total;
            }, 0)
        },
        getTotalLinesRead (user) {
            return this.transactions.reduce((total, transaction) => {
                return (transaction.user_id === user.id && transaction.type === 'line') ? total + transaction.amount : total;
            }, 0)
        },
        getTotalTransactionoReward (user) {
            return this.transactions.reduce((total, transaction) => {
                return (transaction.user_id === user.id) ? total + transaction.amount : total;
            }, 0)
        },
    }
}
</script>

<style scoped>

</style>
