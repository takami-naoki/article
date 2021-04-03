<template>
  <div>
    <div class="p-4">
      <div class="card-columns mx-auto">
        <div v-for="( article, key, index ) in articles" :key="key" class="card mx-auto">
          <div class="card-body">
            <h5 class="card-title">
              <router-link :to="{ name: 'detail', params: { id: article.id } }">{{article.title}}</router-link>
            </h5>
            <h5 class="card-text">{{article.full_description}}</h5>
            <p class="card-text"><small class="text-muted">Created {{article.created}}</small> <small class="text-muted">by {{article.author_name}}</small></p>
          </div>
        </div>
      </div>
    </div>
    <ul class="pagination mx-auto" style="width: 240px;">
      <li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
        <a class="page-link" href="#" v-on:click="list(pagination.prev_page_url)">Previous</a>
      </li>
      <li class="page-item">
        <a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
      </li>
      <li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="page-item">
        <a class="page-link" href="#" v-on:click="list(pagination.next_page_url)">Next</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      pagination: {},
    }
  },
  mounted() {
    this.list();
  },
  methods: {
    list(page_url = null) {
      let url = page_url == null ? 'http://18.217.62.142/api/articles' : page_url;
      fetch(url)
          .then(res => res.json())
          .then(res => {
            this.articles = res.data;
            this.pagination = res.pagination;
            this.$set(this.articles, res);
          })
          .catch(err => {
            console.log(err)
          });
    }
  }
}
</script>