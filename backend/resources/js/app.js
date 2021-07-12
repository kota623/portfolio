import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'
import FollowButton from './components/FollowButton'
import Anime from './components/Anime'
import ArticleIsPublic from './components/ArticleIsPublic'
Vue.config.debug = true;
const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleTagsInput,
    FollowButton,
    Anime,
    ArticleIsPublic,
  }
})
