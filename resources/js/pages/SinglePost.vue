<template>
    <div v-if="post" class="container">
        <h1>{{post.title}}</h1>
        <img v-if="post.image_path" :src="post.image_path" :alt="post.title">
        <img v-if="post.image" :src="`/storage/${post.image}`" :alt="post.title">
        <p>{{post.content}}</p>
        <h3>Autore di questo post: {{post.user.name}}</h3>  <p v-if="post.category">Categoria: {{post.category.name}}</p>
        <div v-if="post.tags.length > 0">
            <h4>Lista tags</h4>
            <ul>
                <li v-for="tag in post.tags" :key="tag.id"><router-link :to="{ name: 'single-tag', params: {slug: tag.slug} }">{{tag.name}}</router-link></li>
            </ul>
        </div>
        <div class="mt-3" v-if="post.comments.length > 0">
            <h3>Commenti</h3>
            <ul>
                <li v-for="comment in post.comments" :key="comment.id">
                    <h4>{{comment.name ? comment.name : 'Anonimo'}}</h4>
                    <div>
                        {{comment.content}}
                    </div>
                </li>
            </ul>
        </div>
        <div class="mt-3">
            <h3>Lascia un commento</h3>
            <form @submit.prevent="addComment()">
                <div class="mb-1">
                    <input type="text" name="name" placeholder="Inserisci il nome" v-model="formData.name">
                    <ul v-if="errors.name" style="color:red">
                        <li v-for="(err, index) in errors.name" :key="index">{{err}}</li>
                    </ul>
                </div>
                <div class="mb-1">
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="Inserisci il testo del commento" v-model="formData.content"></textarea>
                    <ul v-if="errors.content" style="color:red">
                        <li v-for="(err, index) in errors.content" :key="index">{{err}}</li>
                    </ul>
                </div>
                <div>
                    <button type="submit">Aggiungi Commento</button>
                </div>
                <div v-if="commentSent" class="mt-3" style="color: green; border: 1px solid green">
                    Commento inserito in fase di approvazione
                </div>
            </form>
        </div>
        <div class="mt-5">
            <router-link :to="{name: 'home'}">Home Page</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            post: null,
            formData: {
                name: '',
                content: '',
            },
            commentSent: false,
            errors: {}
        }
    },
    created() {
        // console.log(this.$route.params.slug);
        axios.get(`/api/posts/${this.$route.params.slug}`)
            .then((response) => {
                this.post = response.data;
            })
            .catch((e) => {
                // redirect alla pagina 404
                this.$router.push({name: 'page-404'});
            });
    },
    methods: {
        addComment() {
            // richiesta axios di tipo post per aggiungere il commento
            axios.post(`/api/comments/${this.post.id}`, this.formData)
                .then((resp) => {
                    // console.log(resp.data.data);
                    this.commentSent = true;
                    this.formData.name = "";
                    this.formData.content = "";
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        }
    }
}
</script>

<style>

</style>