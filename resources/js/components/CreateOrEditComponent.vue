<template>
  <div>
    <div class="list-group">
      <router-link v-for="( item, key, index ) in items" :key="key" :to="{ name: 'detail', params: { id: item.id } }" class="list-group-item">
        {{ item.title }}
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      article: {
        id: '',
        title: '',
        short_description: '',
        full_description: '',
      }
    }
  },
  created() {
    console.log("aaa");
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
          this.articles = res.data;
        })
        .catch(err => console.log(err))
    }
  }
}
</script>