<template>
    <div>
        <h4 class="text-left ml-10">Create Contact</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addContact">
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
                        <select class="form-select" v-model="contact.gender">
                            <option :value="null">--Select Gender--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label>Content</label>
                        <textarea v-model="contact.content" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create Contact</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contact: {},
            errors: {}
        }
    },
    methods: {
        addContact() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/contacts', this.contact)
                    .then(response => {
                        this.$router.push({name: 'contacts'})
                    })
                    .catch(function (error) {
                        console.log(error.response.data.errors, 'here');
                        if (error.response.status === 422) {
                            let errors = error.response.data.errors;
                            for(let i = 0; i < errors.length; i++) {
                                console.log(errors[i])
                            }
                            this.errors = errors;
                            console.error(errors);
                        }
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
