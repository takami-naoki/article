<template>
  <div>
    <template v-if="isAlert == true">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong style="white-space: pre-line">{{ alertMessage }}</strong>
        <button v-on:click="closeAlert()" type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </template>

    <div class="form-group p-5 m-5">
      <h2>Title</h2>
      <input type="text" name="title" class="form-control mb-2" maxlength="50" v-model="article.title">
      <h2>Short Description</h2>
      <input type="text" name="short_description" maxlength="255" class="form-control mb-2" v-model="article.short_description">
      <h2>Full Description</h2>
      <textarea name="full_description" maxlength="255" class="form-control mb-2" v-model="article.full_description"></textarea>
      <div class="text-right mt-3" v-if="(article != null && article.is_mine == true) || isEdit == false">
        <button v-on:click="onUpdate(article.id)" type="button" class="btn btn-success pr-2">{{ isEdit == true ? "Update" : "Create" }}</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isAlert: false,
      alertMessage: "",
      isEdit: true,
      article: {
        id: '',
        title: '',
        short_description: '',
        full_description: '',
      }
    }
  },
  created() {
    this.one();
  },
  methods: {
    one: function() {
      if (this.$route.params.id == null) {
        this.isEdit = false;
        return;
      }
      let url = 'http://18.217.62.142/api/articles/' + this.$route.params.id;
      fetch(url)
          .then(res => res.json())
          .then(res => {
            this.article = res
          });
    },
    onUpdate: function(id) {
      let url = id == "" || id == null ? 'http://18.217.62.142/api/articles' : 'http://18.217.62.142/api/articles/' + id;
      axios.post(url, this.article)
          .then(res => {
            if (this.isEdit == false) {
              this.$router.push('list');
            } else {
              this.isAlert = true;
              this.alertMessage = "Update Successfully!";
            }
          })
          .catch(err => {
            this.alertMessage = "";
            if (Object.keys(err.response.data.errors).length > 0) {
                for (let key in err.response.data.errors) {
                  this.alertMessage += err.response.data.errors[key].join(",") + "\n";
                }
            } else {
              this.alertMessage = "Something went wrong!";
            }
            this.isAlert = true;
          });
    },
    closeAlert: function() {
      this.isAlert = false;
    }
  }
}
</script>