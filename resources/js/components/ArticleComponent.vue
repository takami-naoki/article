<template>
  <div>
    <div class="card-groups mb-3">
      <router-link v-for="( article, key, index ) in articles" :key="key" :to="{ name: 'detail', params: { id: article.id } }" class="card">
        <div class="card-body">
          <h5 class="card-title">{{article.title}}</h5>
          <h5 class="card-title">{{article.short_description}}</h5>
        </div>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
    }
  },
  mounted() {
    this.list();
  },
  methods: {
    list() {
      let vm = this;
      let url = 'http://18.217.62.142/api/articles';
      fetch(url)
          .then(res => res.json())
          .then(res => {
            console.log(res);
            this.articles = res;
            this.$set(this.articles, res)
          })
          .catch(err => console.log(err))
    }
  }
}
</script>