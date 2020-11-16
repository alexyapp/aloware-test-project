<template>
    <li class="mb-3 p-3 border">
        <p class="mb-0">Name: {{ comment.name }}</p>
        <p class="mb-0">Comment: {{ comment.body }}</p>
        <p class="mb-0">Created At: {{ createdAt }}</p>

        <div v-if="mayHaveReplies" class="mb-3">
            <a href="#" @click.prevent="clicked = true">Reply</a>
        </div>

        <div v-if="mayHaveReplies">
            <add-comment v-show="clicked" :entity="comment" @commentAdded="onAddComment"></add-comment>

            <comment-list :entity="comment"></comment-list>
        </div>
    </li>
</template>

<script>
    import moment from 'moment';

    export default {
        data: () => ({
            clicked: false
        }),
        components: {
            AddComment: () => import('../AddComment/AddComment.vue'),
            CommentList: () => import('../CommentList/CommentList.vue')
        },
        props: {
            comment: {
                type: Object,
                required: true
            }
        },
        computed: {
            createdAt() {
                return moment(this.comment.created_at).format('LLL');
            },
            mayHaveReplies() {
                return 'comments' in this.comment;
            }
        },
        methods: {
            onAddComment(comment) {
                this.clicked = false;
                this.comment.comments.unshift(comment);
            }
        }
    }
</script>
