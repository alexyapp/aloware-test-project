<template>
  <div class="mb-3">
      <form @submit.prevent="addComment">
          <div class="form-group">
              <input class="form-control" type="text" name="name" v-model="name" placeholder="Name" autofocus>
          </div>
          <div class="form-group">
              <textarea class="form-control" name="body" id="body" v-model="body" placeholder="Comment"></textarea>
          </div>

          <button class="btn btn-primary" :disabled="loading">{{ loading ? 'Adding Comment...' : 'Add Comment' }}</button>
      </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        entity: {
            type: Object,
            required: true
        },
    },
    data: () => ({
        name: '',
        body: '',
        loading: false,
    }),
    methods: {
        async addComment() {
            this.loading = true;
            
            try {
                const { name, body } = this;
                
                let { data: { data: comment } } = await axios.post(`/${this.entity.commentable_type}/${this.entity.id}/comments`, { name, body });

                this.$emit('commentAdded', comment);

                this.name = '';
                this.body = '';
            } catch (e) {
                const { status, data: { errors } } = e.response;

                if (status === 422) {
                    for (let key in errors) {
                        this.$toast.open({
                            message: errors[key][0],
                            type: 'error',
                            position: 'top-right'
                        });
                    }
                }
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>

<style>

</style>