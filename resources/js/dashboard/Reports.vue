<template>
    <el-main>

        <el-header>
            <el-row :gutter="20">

                <el-button style="margin-right:20px;" type="primary" @click="filtersVisible = true">Filter</el-button>

                <el-tag v-for="(value, index) in filters"
                        :key="index"
                        closable
                        style="margin-right: 10px;"
                        @close="closeFilter(index)"
                >
                    {{ index }}: {{ value }}
                </el-tag>
            </el-row>


            <el-dialog :visible.sync="filtersVisible"
                       title="Tips">
                <el-form ref="form" :model="filters" label-width="120px">

                    <el-form-item label="Filters by gender">
                        <el-select
                            v-model="filters.gender"
                            clearable
                            placeholder="Filter by gender"
                            @clear="closeFilter('gender')">
                            <i slot="prefix" class="el-input__icon el-icon-calendar"></i>
                            <el-option label="Male" value="male"></el-option>
                            <el-option label="Female" value="female"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="Display users that read more lines than">
                        <el-input
                            v-model="filters.lines_read"
                            clearable
                            placeholder="Number"
                            type="number"
                            @clear="closeFilter('lines_read')">
                            <i slot="prefix" class="el-input__icon el-icon-calendar"></i>
                        </el-input>
                    </el-form-item>

                </el-form>

                <div slot="footer" class="dialog-footer">
                    <el-button type="primary" @click="filtersVisible = false">Close</el-button>
                </div>
            </el-dialog>
        </el-header>

        <el-table v-if="filteredUsers.length"
                  :data="filteredUsers"
                  :default-sort="{prop: 'id'}"
                  style="width: 100%"
        >
            <el-table-column label="ID" prop="id" sortable width="60">
                <template slot-scope="scope">
                    #<span>{{ scope.row.id }}</span>
                </template>
            </el-table-column>
            <el-table-column label="Username" prop="username" sortable width="120">
                <template slot-scope="scope">
                    {{ scope.row.username }}
                </template>
            </el-table-column>
            <el-table-column label="Name" prop="name" sortable width="100">
                <template slot-scope="scope">
                    {{ scope.row.first_name }}
                </template>
            </el-table-column>
            <el-table-column label="Last name" prop="last_name" sortable width="120">
                <template slot-scope="scope">
                    {{ scope.row.last_name }}
                </template>
            </el-table-column>
            <el-table-column label="TimeRead" prop="times_read" sortable width="120">
                <template slot-scope="scope">
                    {{ scope.row.times_read }}
                </template>
            </el-table-column>
            <el-table-column label="LinesRead" prop="lines_read" sortable width="120">
                <template slot-scope="scope">
                    {{ scope.row.lines_read }}
                </template>
            </el-table-column>
            <el-table-column label="Membership rewards" prop="reward" sortable
                             width="180">
                <template slot-scope="scope">
                    {{ scope.row.reward }}
                </template>
            </el-table-column>
            <el-table-column label="Created at" prop="date" sortable width="120">
                <template slot-scope="scope">
                    {{ formatDate(scope.row.created_at) }}
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
            filtersVisible: false,
            filters: {},
        }
    },
    computed: {
        filteredUsers() {
            return this.users.filter(user => {
                if (this.filters.gender) {
                    return user.gender === this.filters.gender
                } else if (this.filters.lines_read) {
                    return user.lines_read > this.filters.lines_read
                } else {
                    return user;
                }
            })
        }
    },
    mounted() {

        axios.get('/api/reports').then(response => {
            this.users = response.data.users;
            this.transactions = response.data.transactions;
        })
    },
    methods: {
        compareDate(dateA, dateB) {
            return dateA > dateB;
        },
        closeFilter(filter) {
            this.$delete(this.filters, filter);
        },
        formatDate(date) {
            let dateObject = new Date(date)
            return dateObject.getDate() + "-" + (dateObject.getMonth() + 1) + "-" + dateObject.getFullYear()
        }
    }
}
</script>

<style scoped>

</style>
