<template>
<div>
  <div class="card" v-if="article">
    <div class="card-body">
      <h1 class="card-title">{{article.title}}</h1>
      <div class="card-text">{{article.short_description}}</div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      article: null,
      editFlag: false,
      updated: false
    }
  },
  mounted() {
    console.log("a");
    this.one();
  },
  methods: {
    one: function() {
      let url = 'http://18.217.62.142/api/articles/' + this.$route.params.id;
      console.log(url);
      fetch(url)
          .then(res => res.json())
          .then(res => {
            console.log(res);
            this.article = res
          });
    }
  }
}
</script>