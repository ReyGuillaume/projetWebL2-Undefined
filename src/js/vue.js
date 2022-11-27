const Home = {
  template:'#home',
  name : 'Home'
}

const SearchArticle = {
  template:'#search-page',
  name : 'SearchArticle',
  data() {
    return {
      articles: [],
      filtered_articles: [],
      brands: [],
      genders: [],
      categories: [],
      sub_categories: [],
      displayed_sub_categories: [],
      gender_key: 0,
      brand_key: 0,
      category_key: 0,
      sub_category_key: 0,
      loaded: false,
    };
  },
  methods: {
    fetchAllArticles() {
      axios
        .get(
          "services/search_page/search_page.php?function=retrieveAllArticles"
        )
        .then((response) => {
          this.articles = response.data;
          this.filtered_articles = response.data;
        });
    },

    fetchAllBrands() {
      axios
        .get("services/search_page/search_page.php?function=retrieveAllBrands")
        .then((response) => {
          this.brands = response.data;
        });
    },

    fetchAllGenders() {
      axios
        .get("services/search_page/search_page.php?function=retrieveAllGenders")
        .then((response) => {
          this.genders = response.data;
        });
    },

    fetchAllCategories() {
      axios
        .get(
          "services/search_page/search_page.php?function=retrieveAllCategories"
        )
        .then((response) => {
          this.categories = response.data;
        });
    },

    fetchAllSubCategories() {
      axios
        .get(
          "services/search_page/search_page.php?function=retrieveAllSubCategories"
        )
        .then((response) => {
          this.sub_categories = response.data;
          this.displayed_sub_categories = response.data;
        });
    },

    async handleFilterChange() {
      url = "services/search_page/search_page.php?function=retrieveArticlesFiltered"
              + "&gender_key=" + (this.gender_key != 0 ? this.gender_key : "")
              + "&brand_key=" + (this.brand_key != 0 ? this.brand_key : "")
              + "&category_key=" + (this.category_key != 0 ? this.category_key : "")
              + "&subcategory_key=" + (this.sub_category_key != 0 ? this.sub_category_key : "");

      await axios.get(url)
      .then((response) => {
        this.filtered_articles = response.data;
      });
    },

    handleCategoryChange() {
      temp_displayed_sub_category = [];
      this.sub_category_key = 0;
      for (sub_category of this.sub_categories) {
        if (sub_category.id_category == this.category_key) {
          temp_displayed_sub_category.push(sub_category);
        }
      }
      this.displayed_sub_categories = temp_displayed_sub_category;
      this.handleFilterChange();
    },

    handleResetFilters(){
      this.gender_key = 0;
      this.brand_key = 0; 
      this.category_key = 0; 
      this.sub_category_key = 0;
      this.filtered_articles = this.articles;
    }
  },
  mounted() {
    (async () => {
      await this.fetchAllArticles();
      await this.fetchAllBrands();
      await this.fetchAllGenders();
      await this.fetchAllCategories();
      await this.fetchAllSubCategories();
    })();

    setTimeout(() => (this.loaded = true), 1000);
  }
}

const UserProfile = {
  template:'<h1>User Profile</h1>',
  name : 'UserProfile'
}

const router = new VueRouter.createRouter({
  history: VueRouter.createWebHashHistory(),

  routes : [
    { path: '/', component: Home, name : 'Home' },
    { path: '/search-article', component: SearchArticle, name : 'SearchArticle'},
    { path: '/user-profile', component: UserProfile, name : 'UserProfile' },
  ]
})

const app = Vue.createApp({})

app.use(router)
app.mount('#app')