<template>
<div class="m-5 p-5">
  <div class="card" v-if="article">
    <div class="card-body">
      <h1 class="card-title">{{article.title}}</h1>
      <div class="card-text">{{article.short_description}}</div>
      <h5 class="card-text">{{article.full_description}}</h5>
      <p class="card-text"><small class="text-muted">Created {{article.created}}</small> <small class="text-muted">by {{article.author_name}}</small></p>
    </div>
  </div>
  <div class="text-right mt-3" v-if="article != null && article.is_mine == true">
    <router-link :to="{ name:'createOrEdit', params: { id: article.id } }">
      <button type="button" class="btn btn-success pr-2">Edit</button>
    </router-link>
    <button v-on:click="onDelete(article.id)" type="button" class="btn btn-danger">Delete</button>
  </div>
  <h2>Comments</h2>
  <div class="card-list">
    <template v-if="article">
      <div v-for="( comment, key, index ) in article.comments" :key="key" class="card p-3 mb-2">
        <div>
          <div>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> <span><small class="font-weight-bold text-primary">{{ comment.user_name }}</small> <small class="font-weight-bold">{{ comment.comment }}</small></span> </div> <small>Created {{ comment.created }}</small>
        </div>
      </div>
    </template>
  </div>
  <textarea name="comment" v-model="comment" class="form-control mb-2"></textarea>
  <div class="text-right">
    <button v-on:click="onComment(article.id)" type="button" class="btn btn-secondary">Comment</button>
  </div>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      article: {
        id: "",
        title: "",
        short_description: "",
        full_description: "",
        crated: "",
        comment: "",
      },
      comment: ""
    }
  },
  mounted() {
    this.one();
  },
  methods: {
    one: function() {
      let url = 'http://18.217.62.142/api/articles/' + this.$route.params.id;
      fetch(url)
          .then(res => res.json())
          .then(res => {
            this.article = res
          });
    },
    onComment: function(id) {
      let url = 'http://18.217.62.142/api/comments/' + id;
      this.article.comment = this.comment
      axios.post(url, this.article)
        .then(res => {
          // this.article.comments.push(this.comment);
          window.location.href = 'http://18.217.62.142/articles/detail/' + this.$route.params.id;
        })
        .catch(err => { console.log(err) });
    }
  }
}
</script>