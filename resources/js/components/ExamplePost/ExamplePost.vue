<template>
  <div class="container">
      <div class="row justify-content-center my-3">
          <div class="col-md-8">
              <div>
                  <h1>I am a Post</h1>
                  <h5>Feed me comments!</h5>
              </div>
          </div>
      </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <add-comment :entity="post" @commentAdded="onAddComment"></add-comment>
            </div>
        </div>

      <div class="row justify-content-center">
          <div class="col-md-8">
              <comment-list :entity="post"></comment-list>
          </div>
      </div>
  </div>
</template>

<script>
import AddComment from '../AddComment/AddComment.vue';
import CommentList from '../CommentList/CommentList.vue';

export default {
    data: () => ({
        post: {}
    }),
    components: {
        AddComment,
        CommentList
    },
    async mounted() {
        try {
            let { data: { data: post } } = await axios.get(`/posts/${1}`);

            if (post) {
                this.post = post;
            }
        } catch (e) {
            // TODO: handle error
        }
    },
    methods: {
        onAddComment(comment) {
            this.post.comments.unshift(comment);
        }
    }
}
</script>

<style>

</style>