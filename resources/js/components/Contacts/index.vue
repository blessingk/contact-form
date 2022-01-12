<template>
    <div>
        <h4 class="text-center">Contacts</h4><br/>
        <div class="row text-right">
            <div class="col-md-3 offset-2">
                <div class="form-group">
                    <label>Filter gender</label>
                    <select class="form-select" @change="filterContacts" v-model="filterForm.gender">
                        <option value="null">--Select Gender--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Search</label>
                    <input type="search" @input="filterContacts" v-model="filterForm.search" class="form-control">
                </div>
            </div>
            <div class="col-md-3 mt-4 offset-1">
                <button type="button" class="btn btn-info" @click="this.$router.push('/new-contact')">Add New Contact</button>
            </div>
        </div>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts" :key="contact.id">
                    <td>{{ contact.id }}</td>
                    <td>{{ contact.name }}</td>
                    <td>{{ contact.email }}</td>
                    <td>{{ contact.gender }}</td>
                    <td>{{ contact.content }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'single-contact', params: { id: contact.id }}" class="btn btn-primary mr-2">Edit</router-link>
                            <button class="btn btn-danger ml-3" @click="deleteContact(contact.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contacts: [],
            filterForm: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/contacts')
                .then(response => {
                    this.contacts = response.data.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteContact(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/contacts/${id}`)
                    .then(response => {
                        let i = this.contacts.map(item => item.id).indexOf(id); // find index of your object
                        this.contacts.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },

        filterContacts() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get(`/api/contacts`, {
                        params: this.filterForm
                    })
                    .then(response => {
                        this.contacts = response.data.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Auth.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
