<template>
    <div>
        <h4 class="text-center">All Contcts</h4><br/>
        <table class="table table-bordered">
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
                        <router-link :to="{name: 'single-contact', params: { id: contact.id }}" class="btn btn-primary">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteBook(contact.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/contacts/create')">Add Contact</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contacts: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/books')
                .then(response => {
                    this.contacts = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteBook(id) {
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
