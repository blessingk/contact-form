<template>
    <div>
        <h4 class="text-left ml-10">Create Contact</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger mb-5" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <form @submit.prevent="addContact">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="contact.name">
                        <div class="error text-danger mb-1" role="alert" v-if="errors && errors?.name">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="contact.email">
                        <div class="error text-danger mb-1" role="alert" v-if="errors && errors?.email">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label>Gender</label>
                        <select class="form-select" v-model="contact.gender">
                            <option :value="null">--Select Gender--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="error text-danger mb-1" role="alert" v-if="errors && errors?.gender">
                            {{ errors.gender[0] }}
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label>Content</label>
                        <textarea v-model="contact.content" class="form-control"></textarea>
                        <div class="error text-danger mb-1" role="alert" v-if="errors && errors?.content">
                            {{ errors.content[0] }}
                        </div>
                    </div>
                    <button :disabled="disabled" type="submit" class="btn btn-primary mt-2">
                        <span v-if="disabled">Creating...</span>
                        <span v-else>Create Contact</span>
                    </button>
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
            errors: null,
            error: null,
            disabled: false
        }
    },
    methods: {
        addContact() {
            this.disabled = true;
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/contacts', this.contact)
                    .then(response => {
                        this.$router.push({name: 'contacts'});
                        this.disabled = false;
                    })
                    .catch(error =>  {
                        this.disabled = false;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        } else {
                            this.error = 'Something went wrong please try again!'
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
