<template>
    <el-main>

        <el-header>
            <el-button type="primary" @click="openNewUserForm">Add User</el-button>
        </el-header>

        <el-table v-if="users.length"
                  :data="users"
                  style="width: 100%">
            <el-table-column label="ID" width="60">
                <template slot-scope="scope">
                    #<span>{{ scope.row.id }}</span>
                </template>
            </el-table-column>
            <el-table-column label="Name" width="300">
                <template slot-scope="scope">
                    {{ scope.row.first_name + ' ' + scope.row.last_name }}
                </template>
            </el-table-column>
            <el-table-column label="Username" width="100">
                <template slot-scope="scope">
                    {{ scope.row.username }}
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
            <el-table-column
                fixed="right"
                label="Operations">
                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        @click="handleEditUser(scope.$index, scope.row)">Edit
                    </el-button>
                    <el-popconfirm
                        confirm-button-text='Delete'
                        cancel-button-text='Cancel'
                        icon="el-icon-warning"
                        icon-color="red"
                        @confirm="deleteUser(scope.row)"
                        title="Are you sure to delete this user?"
                    >
                        <el-button slot="reference" size="mini" type="danger">Delete</el-button>
                    </el-popconfirm>

                </template>
            </el-table-column>
        </el-table>

        <el-pagination style="margin-top: 40px;"
                       :hide-on-single-page="true"
                       :page-size="5"
                       layout="prev, pager, next"
                       :current-page="pagination.current_page"
                       @current-change="updatePage"
                       @size-changed="updatePage"
                       :total="pagination.total">
        </el-pagination>


        <el-dialog title="Edit user" :visible.sync="editUserFormVisible">
            <el-form :model="editedUser">
                <el-row :gutter="10">
                    <el-col :span="12">
                        <el-form-item label="First name">
                            <el-input v-model="editedUser.first_name" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="Last name">
                            <el-input v-model="editedUser.last_name" autocomplete="off"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item label="Birthday">
                    <el-date-picker
                        v-model="editedUser.dob"
                        type="date"
                        format="dd-MM-yyyy"
                        value-format="dd-MM-yyyy"
                        placeholder="Pick a day">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="Gender">
                    <el-select v-model="editedUser.gender" placeholder="Please select a gender">
                        <el-option label="Unspecified" value=""></el-option>
                        <el-option label="Male" value="male"></el-option>
                        <el-option label="Female" value="female"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Role">
                    <el-select v-model="editedUser.role_id" placeholder="Please select a role">
                        <el-option v-for="role in roles" :key="role.id" :label="role.name" :value="role.id"></el-option>
                    </el-select>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="cancelEditUser">Cancel</el-button>
                <el-button type="primary" @click="updateEditedUser">Update</el-button>
            </div>
        </el-dialog>

    </el-main>
</template>

<script>
export default {
    name: "Users",
    data() {
        return {
            users: [],
            pagination: {},
            editUserFormVisible: false,
            editedUser: {},
            roles: [],
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get(`/api/users?page=${this.$route.params.page}`).then(response => {
                this.pagination = response.data.users
                this.users = response.data.users.data;
                this.roles = response.data.roles
            })
        },
        handleEditUser(index, row) {
            this.editedUser = row;
            this.editUserFormVisible = true;
        },
        openNewUserForm() {
            // TODO
            this.$alert('This functionality is not ready', 'Info', {confirmButtonText: 'Ok'});
        },
        cancelEditUser() {
            this.editedUser = {};
            this.editUserFormVisible = false
        },
        updateEditedUser() {
            axios.post(`/api/users/${this.editedUser.id}`, this.editedUser).then(response => {
                this.users.map(user => response.data.id === user.id ? response.data : user);
                this.$message.success('User data was updated')
                this.cancelEditUser();
            }).catch(error => console.log(error))
        },
        deleteUser(user) {
            axios.delete(`/api/users/${user.id}`).then(response => {
                this.users = this.users.filter(user => parseInt(response.data.id) !== user.id);
                this.$message.success('User was deleted')
                // this.updatePage();
            })
        },
        updatePage(page) {
            if(page !== this.$route.params.page) {
                this.$router.push({params: {page: page}});
                this.getData();
            }
        }
    }
}
</script>

<style scoped>

</style>
