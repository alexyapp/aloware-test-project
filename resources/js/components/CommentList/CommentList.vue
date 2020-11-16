<template>
    <ul>
        <comment v-for="comment in entity.comments" :key="comment.id" :comment="comment"></comment>
    </ul>
</template>

<script>
    import Comment from '../Comment/Comment.vue';

    export default {
        components: {
            Comment
        },
        props: {
            entity: {
                type: Object,
                required: true
            }
        }
    }
</script>
