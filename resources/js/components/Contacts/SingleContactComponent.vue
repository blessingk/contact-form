<template>
    <div>
        <h4 class="text-center">Edit Contact</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateContact">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="contact.name">
                    </div>
                    <div class="form-group mt-2">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="contact.email">
                    </div>
                    <div class="form-group mt-2">
                        <label>Gender</label>
                        <input type="text" class="form-control" v-model="contact.gender">
                    </div>
                    <div class="form-group mt-2">
                        <label>Content</label>
                        <textarea v-model="contact.content" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Contact</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contact: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/contacts/${this.$route.params.id}`)
                .then(response => {
                    this.contact = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateBook() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.put(`/api/contacts/${this.$route.params.id}`, this.contact)
                    .then(response => {
                        this.$router.push({name: 'contacts'});
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
